<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use File;
use mysql_xdevapi\Exception;
use ZipArchive;
use App\Models\User;
use App\Models\Login;
use App\Models\Billing;
use App\Models\Insurance;
use App\Models\Credential;
use App\Models\FormStatus;
use App\Models\LoginStatus;
use Illuminate\Http\Request;
use App\Models\FormDocStatus;
use App\Models\UserInsurance;
use App\Models\DocumentStatus;
use App\Models\BillingDocument;
use App\Models\CredentialStatus;
use App\Models\InsuranceTimeline;
use App\Models\UserCredentialStep;
use App\Models\UserApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CredentialingDocument;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\LazyCollection;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function user_dashboard($id = null)
    {
        $data['page_title'] = "RCM - User Dashboard";
        if ($id != null) {
            $data['credential'] = Credential::with('insurances', 'logins', 'credential_documents','group_document_status_tab_view', 'document_status_tab_view', 'group_status_tab', 'individual_status_tab', 'login_status_tab_view',
                'child_credentials.logins', 'child_credentials.insurances',
                'child_credentials.credential_documents', 'child_credentials.individual_status_tab', 'child_credentials.document_status_tab_view', 'child_credentials.login_status_tab_view')->whereCredentialId($id)->first();
        } else {
            $data['credential'] = Credential::with('insurances', 'logins', 'credential_documents', 'document_status_tab_view', 'group_status_tab', 'individual_status_tab', 'login_status_tab_view',
                'child_credentials.logins', 'child_credentials.insurances',
                'child_credentials.credential_documents', 'child_credentials.individual_status_tab', 'child_credentials.document_status_tab_view', 'child_credentials.login_status_tab_view')->whereUserId(Auth::user()->user_id)->first();
        }
        if (isset($data['credential']) && $data['credential']->credential_documents != null) {
            return view('front_end.user.user_dashboard', $data);
        }
        return redirect()->route('view_individual_credential', ['id' => $id]);
    }

    public function group_dashboard()
    {
        $data['page_title'] = "RCM - Group Dashboard";
        $data['user'] = User::with('group_credential')->whereUserId(Auth::user()->user_id)->first();
        return view('front_end.user.multi_group_dashboard', $data);
    }

    public function view_individual_credential($id, $step = null)
    {
        $data['credential'] = Credential::with('insurances','logins','credential_documents', 'credential_statuses', 'login_statuses', 'document_status', 'document_status_tab_view', 'group_status_tab', 'individual_status_tab', 'login_status_tab_view')->whereCredentialId($id)->first();
        $credential_ids = UserInsurance::whereCredentialId($id)->pluck('insurance_id')->toArray();
        $data['user_insurances'] = Credential::with('insurances')->whereCredentialId($id)->first();
        $data['insurance_list'] = Insurance::whereStatus(1)->whereNotIn('id', $credential_ids)->get();
        $data['list_providers'] = null;
        if ($data['credential']->form_type == 'credentialing_agencies') {
            $data['list_providers'] = Credential::where('form_type', 'credentialing_individual_provider')
                ->whereUserId(Auth::user()->user_id)
                ->where('parent_id', '!=', $data['credential']->credential_id)
                ->where('provider_name','!=',null)
                ->get()
                ->unique('provider_name') ;
        }
        if ($data['credential']->credential_documents != null && $step == null && $data['credential']->form_type == 'credentialing_agencies') {
            return redirect('group_dashboard');
        }
        if ($data['credential']->credential_documents != null && $step == null) {
            $data['user_insurances'] = UserInsurance::with('insurance')->whereCredentialId($id)->get();
            return view('front_end.user.insurance_list', $data);
        }
        return view('front_end.user.credential_form', $data);
    }

    public function user_timeline($credential_id, $insurance_id)
    {
        $data['page_title'] = "RCM - User Timeline";
        $data['credential'] = Credential::with('document_status_tab_view', 'group_status_tab', 'individual_status_tab', 'login_status_tab_view')->whereCredentialId($credential_id)->first();
        $data['user_insurance'] = UserInsurance::with('insurance', 'insurance_timeline')->where(['credential_id' => $credential_id, 'insurance_id' => $insurance_id])->orderBy('id', 'desc')->first();
//        update is read status here
        UserInsurance::where(['credential_id' => $credential_id, 'insurance_id' => $insurance_id])->update(['is_read' => 1]);
        return view('front_end.user.user_timeline', $data);
    }

    public function user_form()
    {
        $data['page_title'] = "RCM - Credentialing Form";
        $data['credential'] = '';
        $data['billing'] = '';
        $data['credential'] = Credential::with('insurances', 'logins', 'credential_documents')->whereUserId(Auth::user()->user_id)->first();
        $credential_ids = [];
        if (isset($data['credential'])) {
            $credential_ids = UserInsurance::whereCredentialId($data['credential']->credential_id)->pluck('insurance_id')->toArray();
            $data['user_insurances'] = Credential::with('insurances')->where('credential_id', $data['credential']->credential_id)->first();
        }
        $data['insurance_list'] = Insurance::whereStatus(1)->whereNotIn('id', $credential_ids)->get();
        return view('front_end.user.credential_form', $data);
    }

    public function get_billing_and_credentialing()
    {
        $users = User::get();
        $response['status'] = "Success";
        $response['result'] = $users;
        return response()->json($response);
    }

    public function get_billing_and_credentialing_detial($user_name)
    {
        $users = User::with('group_credential')->where('email', $user_name)->first();
        if (count($users->group_credential)>0){
            $credential = Credential::whereUserId($users->user_id)->where('form_type','credentialing_agencies')->get();
            $response['type'] = 'group';
        }else{
            $credential = Credential::with('logins', 'credential_documents', 'insurances.user_insurances.insurance_timeline', 'credential_indiviudal_status_count', 'credential_group_status_count', 'credential_statuses', 'login_statuses', 'document_status',
                'child_credentials.logins', 'child_credentials.credential_documents', 'child_credentials.credential_indiviudal_status_count', 'child_credentials.insurances.user_insurances.insurance_timeline')
                ->whereUserId($users->user_id)->first();
            $response['type'] = 'individual';
        }
        $response['status'] = "Success";
        $response['result'] = $credential;
        return response()->json($response);
    }

    function get_billing_and_credentialing_detial_byid($credential_id)
    {
        $credentialing_data = DB::select("SELECT * from credentials
                join credentialing_documents
                on credentialing_documents.credential_id = credentials.credential_id
                where credentials.credential_id = ".$credential_id."
                and (
                credentialing_documents.state_license_image !='' ||
                credentialing_documents.accreditation_image !='' ||
                credentialing_documents.irs_letter_image !='' ||
                credentialing_documents.bank_letter_image !=''||
                credentialing_documents.professional_liability_insurance_image !='' ||
                credentialing_documents.driver_license_image !='' ||
                credentialing_documents.w9_form_image !='' ||
                credentialing_documents.resume_image !=''||
                credentialing_documents.additional_document_image !=''||
                credentialing_documents.degree_image !=''
                )");
        if ($credentialing_data != []) {
            $user_dir = $credentialing_data[0]->legal_name . $credential_id . 'credentialing';
            $zip = new ZipArchive;
            $directoryename = public_path('zip_file/' . $user_dir . '.zip');
            $rootPath = public_path('zip_file/' . $user_dir);
            if (!File::isDirectory($rootPath)) {
                File::makeDirectory($rootPath, 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/state_license_image')) {
                File::makeDirectory($rootPath . '/state_license_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/accreditation_image')) {
                File::makeDirectory($rootPath . '/accreditation_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/irs_letter_image')) {
                File::makeDirectory($rootPath . '/irs_letter_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/bank_letter_image')) {
                File::makeDirectory($rootPath . '/bank_letter_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/professional_liability_insurance_image')) {
                File::makeDirectory($rootPath . '/professional_liability_insurance_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/driver_license_image')) {
                File::makeDirectory($rootPath . '/driver_license_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/w9_form_image')) {
                File::makeDirectory($rootPath . '/w9_form_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/resume_image')) {
                File::makeDirectory($rootPath . '/resume_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/degree_image')) {
                File::makeDirectory($rootPath . '/degree_image', 0777, true, true);
            }
            if (!File::isDirectory($rootPath . '/additional_document_image')) {
                File::makeDirectory($rootPath . '/additional_document_image', 0777, true, true);
            }
            foreach (explode(',', $credentialing_data[0]->state_license_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/state_license_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->accreditation_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/accreditation_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->irs_letter_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/irs_letter_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->bank_letter_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/bank_letter_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->professional_liability_insurance_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/professional_liability_insurance_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->driver_license_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/driver_license_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->w9_form_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/w9_form_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->resume_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/resume_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->degree_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/degree_image/' . $user_file));
                }
            endforeach;
            foreach (explode(',', $credentialing_data[0]->additional_document_image) as $user_file):
                if ($user_file != '') {
                    File::copy(public_path('credential_images/' . $user_file), public_path('zip_file/' . $user_dir . '/additional_document_image/' . $user_file));
                }
            endforeach;
            $zip->open($directoryename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($rootPath),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );
                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($rootPath) + 1);
                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
            }
            File::deleteDirectory(public_path($user_dir));
            $response['status'] = "Success";
            $response['result'] = config('app.url') . '/public/zip_file/' . $user_dir . '.zip';
            return response()->json($response);
//            return response()->download($directoryename);
        } else {
            $response['status'] = "Failed";
            $response['result'] = "User Record Not Found";
            return response()->json($response);
        }
    }

    public function verify_user_email(Request $request)
    {
        if ($request->user_id != '') {
            $user = User::where('email', $request->email)->where('user_id', '!=', $request->user_id)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        if (!$user) {
            $response['status'] = "Success";
            $response['message'] = 'Email is Available!';
            $response['result'] = $user;
        } else {
            $response['status'] = "Failed";
            $response['message'] = 'Email already exists! against user '.$user->full_name;
            $response['result'] = $user;
        }
        return response()->json($response);
    }

    public function form_status(Request $request)
    {
        if ($request->type == 'credential') {
            CredentialStatus::updateOrCreate(
                [
                    'credential_id' => $request->credential_id
                ],
                [
                    $request->field_name => $request->status,
                    $request->field_name . '_message' => $request->reject_message,
                ]
            );
        }
        if ($request->type == 'login') {
            LoginStatus::updateOrCreate(
                [
                    'credential_id' => $request->credential_id
                ],
                [
                    $request->field_name => $request->status,
                    $request->field_name . '_message' => $request->reject_message,
                ]
            );
        }
        if ($request->type == 'doc_status') {
            DocumentStatus::updateOrCreate(
                [
                    'credential_id' => $request->credential_id
                ],
                [
                    $request->field_name => $request->status,
                    $request->field_name . '_message' => $request->reject_message,
                ]
            );
        }
        $response["status"] = "Success";
        $response["result"] = "Status Added Successfully";
        return response()->json($response);
    }

    public function step_2_form_submit(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $form_data = null;
            if ($request->credential_id != null) {
                $form_data = Credential::where('credential_id', $request->credential_id)->first();
            }
            $data = [
                'form_type' => $request->form_type,
                'user_id' => Auth::user()->user_id,
                'provider_name' => $request->provider_name,
                'provider_npi' => $request->provider_npi,
                'group_name' => $request->group_name,
                'group_npi' => $request->group_npi,
                'legal_name' => $request->legal_name,
                'ein_tin' => $request->ein_tin,
                'ssn_number' => $request->ssn_number,
                'billing_mailing_address' => $request->billing_mailing_address,
                'service_address' => $request->service_address,
                'medicare_id' => $request->medicare_id,
                'owner_dob' => $request->owner_dob,
                'start_date' => $request->start_date,
                'check_address' => $request->check_address
            ];
            if ($form_data != null) {
                $form_data->update($data);
            } else {
                $form_data = Credential::create($data);
            }
            $response['status'] = 'Success';
            $response['result'] = 'Details Done';
            $response['credential_id'] = $form_data->credential_id;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function step_3_form_submit(Request $request)
    {
        DB::beginTransaction();
        try {
            $form_data = Credential::where('credential_id', $request->credential_id)->first();
            $credential_id = $form_data->credential_id;
            $parent_id = $form_data->parent_id;
            Login::updateOrCreate(
                ['credential_id' => $credential_id]
                , [
                'user_id' => Auth::user()->user_id,
                'caqh_username' => $request->caqh_username,
                'caqh_password' => $request->caqh_password,
                'nppes_username' => $request->nppes_username,
                'nppes_password' => $request->nppes_password,
                'provider_source_username' => $request->provider_username,
                'provider_source_password' => $request->provider_password,
                'availity_state' => $request->availity_state,
                'availity_username' => $request->availity_username,
                'availity_password' => $request->availity_password,
                'parent_id' => $parent_id
            ]);
            $response['status'] = 'Success';
            $response['result'] = 'Logins Done';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function step_4_form_submit(Request $request)
    {
        DB::beginTransaction();
        try {
            $form_data = Credential::where('credential_id', $request->credential_id)->first();
            if ($request->insurances != null) {
                $form_data->insurances()->sync($request->insurances);
                $response['status'] = 'Success';
                $response['result'] = 'Insurances Done';
            } else {
                $response['status'] = 'Failure ';
                $response['result'] = 'Select Insurance';
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function step_5_form_submit(Request $request)
    {
        DB::beginTransaction();
        try {
            $form_data = Credential::where('credential_id', $request->credential_id)->first();
            $credential_data['user_id'] = Auth::user()->user_id;
            $credential_data['parent_id'] = null;
            if ($form_data->parent_id != null) {
                $credential_data['parent_id'] = $form_data->parent_id;
            }
            $credential_id = $form_data->credential_id;

            $credential = CredentialingDocument::where('credential_id', $credential_id)->first();
            $state_license_image = [];
            if ($request->has('state_license_image')) {
                // Uploading Files
                foreach ($request->file('state_license_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $state_license_image[] = $name;
                }
            }
            if ($request->old_state_license_image) {
                $old_state_license_image = implode(',', $request->old_state_license_image);
                $differenceArray = array_diff(explode(',', $credential->state_license_image), $request->old_state_license_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($state_license_image) > 0) {
                    $new_state_license_image = $old_state_license_image . ',' . implode(',', $state_license_image);
                } else {
                    $new_state_license_image = $old_state_license_image;
                }
            } else {
                if ($credential != '') {
                    $all_state_license_image_files = explode(',', $credential->state_license_image);
                    if ($all_state_license_image_files != null) {
                        foreach ($all_state_license_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_state_license_image = implode(',', $state_license_image);
            }
            $credential_data['state_license_image'] = $new_state_license_image;

            $accreditation_image = [];
            if ($request->has('accreditation_image')) {
                // Uploading Files
                foreach ($request->file('accreditation_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $accreditation_image[] = $name;
                }
            }
            if ($request->old_accreditation_image) {
                $old_accreditation_image = implode(',', $request->old_accreditation_image);
                $differenceArray = array_diff(explode(',', $credential->accreditation_image), $request->old_accreditation_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($accreditation_image) > 0) {
                    $new_accreditation_image = $old_accreditation_image . ',' . implode(',', $accreditation_image);
                } else {
                    $new_accreditation_image = $old_accreditation_image;
                }
            } else {
                if ($credential != '') {
                    $all_accreditation_files = explode(',', $credential->accreditation_image);
                    if ($all_accreditation_files != null) {
                        foreach ($all_accreditation_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_accreditation_image = implode(',', $accreditation_image);
            }
            $credential_data['accreditation_image'] = $new_accreditation_image;

            $irs_letter_image = [];
            if ($request->has('irs_letter_image')) {
                // Uploading Files
                foreach ($request->file('irs_letter_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $irs_letter_image[] = $name;
                }
            }
            if ($request->old_irs_letter_image) {
                $old_irs_letter_image = implode(',', $request->old_irs_letter_image);
                $differenceArray = array_diff(explode(',', $credential->irs_letter_image), $request->old_irs_letter_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($irs_letter_image) > 0) {
                    $new_irs_letter_image = $old_irs_letter_image . ',' . implode(',', $irs_letter_image);
                } else {
                    $new_irs_letter_image = $old_irs_letter_image;
                }
            } else {
                if ($credential != '') {
                    $all_irs_letter_files = explode(',', $credential->irs_letter_image);
                    if ($all_irs_letter_files != null) {
                        foreach ($all_irs_letter_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_irs_letter_image = implode(',', $irs_letter_image);
            }
            $credential_data['irs_letter_image'] = $new_irs_letter_image;

            $bank_letter_image = [];
            if ($request->has('bank_letter_image')) {
                // Uploading Files
                foreach ($request->file('bank_letter_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $bank_letter_image[] = $name;
                }
            }
            if ($request->old_bank_letter_image) {
                $old_bank_letter_image = implode(',', $request->old_bank_letter_image);
                $differenceArray = array_diff(explode(',', $credential->bank_letter_image), $request->old_bank_letter_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($bank_letter_image) > 0) {
                    $new_bank_letter_image = $old_bank_letter_image . ',' . implode(',', $bank_letter_image);
                } else {
                    $new_bank_letter_image = $old_bank_letter_image;
                }
            } else {
                if ($credential != '') {
                    $all_bank_letter_image_files = explode(',', $credential->bank_letter_image);
                    if ($all_bank_letter_image_files != null) {
                        foreach ($all_bank_letter_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_bank_letter_image = implode(',', $bank_letter_image);
            }
            $credential_data['bank_letter_image'] = $new_bank_letter_image;

            $professional_liability_insurance_image = [];
            if ($request->has('professional_liability_insurance_image')) {
                // Uploading Files
                foreach ($request->file('professional_liability_insurance_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $professional_liability_insurance_image[] = $name;
                }
            }
            if ($request->old_professional_liability_insurance_image) {
                $old_professional_liability_insurance_image = implode(',', $request->old_professional_liability_insurance_image);
                $differenceArray = array_diff(explode(',', $credential->professional_liability_insurance_image), $request->old_professional_liability_insurance_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($professional_liability_insurance_image) > 0) {
                    $new_professional_liability_insurance_image = $old_professional_liability_insurance_image . ',' . implode(',', $professional_liability_insurance_image);
                } else {
                    $new_professional_liability_insurance_image = $old_professional_liability_insurance_image;
                }
            } else {
                if ($credential != '') {
                    $all_professional_liability_insurance_image_files = explode(',', $credential->professional_liability_insurance_image);
                    if ($all_professional_liability_insurance_image_files != null) {
                        foreach ($all_professional_liability_insurance_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_professional_liability_insurance_image = implode(',', $professional_liability_insurance_image);
            }
            $credential_data['professional_liability_insurance_image'] = $new_professional_liability_insurance_image;

            $driver_license_image = [];
            if ($request->has('driver_license_image')) {
                // Uploading Files
                foreach ($request->file('driver_license_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $driver_license_image[] = $name;
                }
            }
            if ($request->old_driver_license_image) {
                $old_driver_license_image = implode(',', $request->old_driver_license_image);
                $differenceArray = array_diff(explode(',', $credential->driver_license_image), $request->old_driver_license_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($driver_license_image) > 0) {
                    $new_driver_license_image = $old_driver_license_image . ',' . implode(',', $driver_license_image);
                } else {
                    $new_driver_license_image = $old_driver_license_image;
                }
            } else {
                if ($credential != '') {
                    $all_driver_license_image_files = explode(',', $credential->driver_license_image);
                    if ($all_driver_license_image_files != null) {
                        foreach ($all_driver_license_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_driver_license_image = implode(',', $driver_license_image);
            }
            $credential_data['driver_license_image'] = $new_driver_license_image;

            $w9_form_image = [];
            if ($request->has('w9_form_image')) {
                // Uploading Files
                foreach ($request->file('w9_form_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $w9_form_image[] = $name;
                }
            }
            if ($request->old_w9_form_image) {
                $old_w9_form_image = implode(',', $request->old_w9_form_image);
                $differenceArray = array_diff(explode(',', $credential->w9_form_image), $request->old_w9_form_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($w9_form_image) > 0) {
                    $new_w9_form_image = $old_w9_form_image . ',' . implode(',', $w9_form_image);
                } else {
                    $new_w9_form_image = $old_w9_form_image;
                }
            } else {
                if ($credential != '') {
                    $all_w9_form_image_files = explode(',', $credential->w9_form_image);
                    if ($all_w9_form_image_files != null) {
                        foreach ($all_w9_form_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_w9_form_image = implode(',', $w9_form_image);
            }
            $credential_data['w9_form_image'] = $new_w9_form_image;

            $resume_image = [];
            if ($request->has('resume_image')) {
                // Uploading Files
                foreach ($request->file('resume_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $resume_image[] = $name;
                }
            }
            if ($request->old_resume_image) {
                $old_resume_image = implode(',', $request->old_resume_image);
                $differenceArray = array_diff(explode(',', $credential->resume_image), $request->old_resume_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($resume_image) > 0) {
                    $new_resume_image = $old_resume_image . ',' . implode(',', $resume_image);
                } else {
                    $new_resume_image = $old_resume_image;
                }
            } else {

                if ($credential != '') {
                    $all_resume_image_files = explode(',', $credential->resume_image);
                    if ($all_resume_image_files != null) {
                        foreach ($all_resume_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_resume_image = implode(',', $resume_image);
            }
            $credential_data['resume_image'] = $new_resume_image;
            $degree_image = [];
            if ($request->has('degree_image')) {
                // Uploading Files
                foreach ($request->file('degree_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $degree_image[] = $name;
                }
            }
            if ($request->old_degree_image) {
                $old_degree_image = implode(',', $request->old_degree_image);
                $differenceArray = array_diff(explode(',', $credential->degree_image), $request->old_degree_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($degree_image) > 0) {
                    $new_degree_image = $old_degree_image . ',' . implode(',', $degree_image);
                } else {
                    $new_degree_image = $old_degree_image;
                }
            } else {
                if ($credential != '') {
                    $all_degree_image_files = explode(',', $credential->degree_image);
                    if ($all_degree_image_files != null) {
                        foreach ($all_degree_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_degree_image = implode(',', $degree_image);
            }
            $credential_data['degree_image'] = $new_degree_image;

            $additional_document_image = [];
            if ($request->has('additional_document_image')) {
                // Uploading Files
                foreach ($request->file('additional_document_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $additional_document_image[] = $name;
                }
            }
            if ($request->old_additional_document_image) {
                $old_additional_document_image = implode(',', $request->old_additional_document_image);
                $differenceArray = array_diff(explode(',', $credential->additional_document_image), $request->old_additional_document_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($additional_document_image) > 0) {
                    $new_additional_document_image = $old_additional_document_image . ',' . implode(',', $additional_document_image);
                } else {
                    $new_additional_document_image = $old_additional_document_image;
                }
            } else {
                if ($credential != '') {
                    $all_additional_document_image_files = explode(',', $credential->additional_document_image);
                    if ($all_additional_document_image_files != null) {
                        foreach ($all_additional_document_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_additional_document_image = implode(',', $additional_document_image);
            }
            $credential_data['additional_document_image'] = $new_additional_document_image;
            $board_certification_image = [];
            if ($request->has('board_certification_image')) {
                // Uploading Files
                foreach ($request->file('board_certification_image') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $board_certification_image[] = $name;
                }
            }
            if ($request->old_board_certification_image) {
                $old_board_certification_image = implode(',', $request->old_board_certification_image);
                $differenceArray = array_diff(explode(',', $credential->board_certification_image), $request->old_board_certification_image);
                foreach ($differenceArray as $diff_imgname):
                    File::delete(public_path() . '/credential_images/' . $diff_imgname);
                endforeach;
                if (count($board_certification_image) > 0) {
                    $new_board_certification_image = $old_board_certification_image . ',' . implode(',', $board_certification_image);
                } else {
                    $new_board_certification_image = $old_board_certification_image;
                }
            } else {
                if ($credential != '') {
                    $all_board_certification_image_files = explode(',', $credential->board_certification_image);
                    if ($all_board_certification_image_files != null) {
                        foreach ($all_board_certification_image_files as $sngle_file):
                            File::delete(public_path() . '/credential_images/' . $sngle_file);
                        endforeach;
                    }
                }
                $new_board_certification_image = implode(',', $board_certification_image);
            }
            $credential_data['board_certification_image'] = $new_board_certification_image;
            CredentialingDocument::updateOrCreate(['credential_id' => $credential_id], $credential_data);
            $response['status'] = "Success";
            $response['result'] = 'Documents Added Successfully!';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function individual_form_modal(Request $request)
    {
        $data['credential'] = Credential::Create(['user_id' => Auth::user()->user_id, 'parent_id' => $request->id, 'form_type' => 'credentialing_individual_provider']);
        $data['insurance_list'] = Insurance::whereStatus(1)->get();
        return view('front_end.user.partials.individual_form', $data);
    }

    public function delete_credential(Request $request)
    {
        DB::beginTransaction();
        try {
            Credential::whereCredentialId($request->id)->delete();
            UserInsurance::whereCredentialId($request->id)->delete();
            Login::whereCredentialId($request->id)->delete();
            CredentialingDocument::whereCredentialId($request->id)->delete();
            CredentialStatus::whereCredentialId($request->id)->delete();
            LoginStatus::whereCredentialId($request->id)->delete();
            DocumentStatus::whereCredentialId($request->id)->delete();
            $response['status'] = 'success';
            $response['result'] = 'Credential Provider Deleted Successfully';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function user_form_account()
    {
        $data['page_title'] = "RCM - User Dashboard";
        $data['credential'] = Credential::with('document_status_tab_view', 'group_status_tab', 'individual_status_tab', 'login_status_tab_view')->whereUserId(Auth::user()->user_id)->first();
        return view('front_end.user.user_form_account', $data);
    }

    public function add_insurance_timeline(Request $request)
    {
        if ($request->id != null) {
            InsuranceTimeline::whereId($request->id)->update([
                'user_application_id' => $request->user_application_id,
                'message' => $request->message,
                'created_at' => eastern_date_time(),
                'insurance_status' => $request->status
            ]);
        } else {
            InsuranceTimeline::create([
                'user_application_id' => $request->user_application_id,
                'message' => $request->message,
                'created_at' => eastern_date_time(),
                'insurance_status' => $request->status
            ]);
        }

        $user_insurance_data = [
            'last_update_date' => eastern_date_time(),
            'up_coming_date' => date('Y-m-d H:i:s', strtotime(eastern_date_time() . "+10 days")),
            'is_read' => 0,
        ];

        if ($request->status != null) {
            $user_insurance_data['insurance_status'] = $request->status;
            $user_insurance_data['last_update_date'] = get_date_time();
        }
        if ($request->end_date !== null) {
            $user_insurance_data['start_date'] = $request->end_date;
        }
        if ($request->provider_id !== null) {
            $user_insurance_data['provider_id'] = $request->provider_id;
        }

        UserApplication::where('id', $request->user_application_id)
            ->update($user_insurance_data);

        $response['status'] = 'success';
        $response['result'] = 'Insurance timeline added successfully';
        return response()->json($response);
    }

    public function view_insurance_timeline($user_insurance_id)
    {
        $response['result'] = InsuranceTimeline::with('user_insurances.insurance')->whereUserInsuranceId($user_insurance_id)->orderBy('id', 'desc')->get();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function view_credential_individual($credential_id)
    {
        $response['result'] = Credential::with('logins', 'credential_documents','credential_statuses', 'login_statuses', 'document_status')->whereCredentialId($credential_id)->first();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function view_credential_group($credential_id)
    {
        $response['result'] = Credential::with('child_credentials')
            ->whereCredentialId($credential_id)->first();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function get_credentialing_insurances_detial($user_name)
    {
        $users = User::with('group_credential')->where('email', $user_name)->first();
        if (count($users->group_credential)>0){
            $response['result'] = Credential::whereUserId($users->user_id)->where('form_type','credentialing_agencies')->get();
            $response['type'] = 'group';
        }else{
            $response['result'] = Credential::with('user_insurances.insurance',
                'user_insurances.insurance_timeline',
                'child_credentials.user_insurances.insurance',
                'child_credentials.user_insurances.insurance_timeline')
                ->whereUserId($users->user_id)->first();
            $response['type'] = 'individual';
        }
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function get_credential_group_insurances($credential_id)
    {
//        dd($credential_id);
        $response['result'] = Credential::with('user_insurances.insurance',
            'user_insurances.insurance_timeline',
            'child_credentials.user_insurances.insurance',
            'child_credentials.user_insurances.insurance_timeline')
            ->whereCredentialId($credential_id)->first();
        $response['status'] = "Success";
        return response()->json($response);
    }

    public function personal_form_update(Request $request)
    {
        $form_data = Credential::where('credential_id', $request->credential_id)->first();
        $form_data->update(
            [
                'provider_name' => $request->provider_name,
                'provider_npi' => $request->provider_npi,
                'group_name' => $request->group_name,
                'group_npi' => $request->group_npi,
                'legal_name' => $request->legal_name,
                'ein_tin' => $request->ein_tin,
                'ssn_number' => $request->ssn_number,
                'billing_mailing_address' => $request->billing_mailing_address,
                'service_address' => $request->service_address,
                'medicare_id' => $request->medicare_id,
                'owner_dob' => $request->owner_dob,
                'start_date' => $request->start_date
            ]);
        $response['result'] = 'Personal Info updated Successfully';
        $response['status'] = "Success";
        return response()->json($response);
    }

    public function login_form_update(Request $request)
    {
        $form_data = Credential::where('credential_id', $request->credential_id)->first();
        $user_id = $form_data->user_id;
        if ($form_data->parent_id != null) {
            $parent_id = $form_data->parent_id;
        } else {
            $parent_id = null;
        }
        Login::updateOrCreate(
            ['credential_id' => $request->credential_id]
            , [
            'user_id' => $user_id,
            'caqh_username' => $request->caqh_username,
            'caqh_password' => $request->caqh_password,
            'nppes_username' => $request->nppes_username,
            'nppes_password' => $request->nppes_password,
            'provider_source_username' => $request->provider_source_username,
            'provider_source_password' => $request->provider_source_password,
            'availity_state' => $request->availity_state,
            'availity_username' => $request->availity_username,
            'availity_password' => $request->availity_password,
            'parent_id' => $parent_id
        ]);
        $response['result'] = 'Logins Info Updated Successfully';
        $response['status'] = "Success";
        return response()->json($response);
    }

    public function save_insurances(Request $request)
    {
        if ($request->id != null) {
            Insurance::where('id', $request->id)->update([
                'title' => $request->title
            ]);
            $response['status'] = 'success';
            $response['result'] = 'Insurance Updated Successfully';
        } else {
            Insurance::Create([
                'title' => $request->title
            ]);
            $response['status'] = 'success';
            $response['result'] = 'Insurance Added Successfully';
        }
        return response()->json($response);
    }

    public function get_user_insurances($credential_id)
    {
        $insurance_ids = UserInsurance::where('credential_id', $credential_id)->pluck('insurance_id')->toArray();
        $response['result'] = Insurance::whereNotIn('id', $insurance_ids)->where('status', 1)->get();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function save_user_insurances(Request $request)
    {
        $insurances = json_decode($request->insurances);
        foreach ($insurances as $insurance) {
            UserInsurance::create([
                'credential_id' => $request->credential_id,
                'insurance_id' => $insurance
            ]);
        }
        $response['result'] = 'Insurances added successfully';
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function remove_insurance(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->user_insurance_id != null) {
                UserInsurance::whereId($request->user_insurance_id)->delete();
                InsuranceTimeline::where('user_insurance_id', $request->user_insurance_id)->delete();
                $response['status'] = 'Success';
                $response['result'] = 'User insurance deleted successfully';
            } else {
                $response['status'] = 'Failure';
                $response['result'] = 'User Insurance Id Not Found';
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response['status'] = 'Failure';
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }

    public function get_billing_documents($email)
    {
        $response['result'] = User::with('user_billing.billing_document')->where('email', $email)->first();
        return response()->json($response);
    }

    function checking_password(Request $request)
    {
        $user = User::where([
            'user_id' => $request->input('user_id'),
            'password' => $this->encrypt_password($request->input('old_pass')),
        ])->first();
        if ($user) {
            $response['status'] = "Success";
            $response['result'] = "Password Correct";
        } else {
            $response['status'] = "Failure";
            $response['result'] = "Password Not Correct";
        }
        return response()->json($response);
    }

    function update_user_profile(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        if ($request->new_password != null && $request->old_password != null) {
            if ($user->password == $this->encrypt_password($request->old_password)) {
                $user_data = [
                    'full_name' => $request->full_name,
                    'password' => $this->encrypt_password($request->input('new_password')),
                ];
                $user->update($user_data);
//                $url = 'http://datacenter.atlantisrcm.com:5656/rcm_crm/api/update_password';
//                $curl = curl_init();
//                curl_setopt_array($curl, array(
//                    CURLOPT_URL => $url,
//                    CURLOPT_RETURNTRANSFER => true,
//                    CURLOPT_ENCODING => '',
//                    CURLOPT_MAXREDIRS => 10,
//                    CURLOPT_TIMEOUT => 0,
//                    CURLOPT_FOLLOWLOCATION => true,
//                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                    CURLOPT_CUSTOMREQUEST => 'post',
//                    CURLOPT_POSTFIELDS => array(
//                        'email' => $user->email,
//                        'password' => $request->input('new_password')
//                    ),
//                    CURLOPT_HTTPHEADER => array(
//                        'RCM-API-KEY:'. env("RCM_API_KEY"),
//                        "Access-Control-Allow-Origin: *"
//                    ),
//                ));
//                $response = curl_exec($curl);
//                if (curl_exec($curl) === false) {
//                    dd(curl_error($curl),curl_errno($curl));
//                } else {
//                    dd("error");
//                }
//                curl_close($curl);
//                $response = json_decode($response);
//                dd($response,array(
//                    'email' => $user->email,
//                    'password' => $request->input('new_password')
//                ));
//                $response['Api_response'] = json_decode($response);
                $response['status'] = "Success";
                $response['result'] = "User updated Successfully";
            } else {
                $response['status'] = "Failure";
                $response['result'] = "Old password is incorrect!";
            }
        } elseif ($request->new_password != null && $request->old_password == null) {
            $response['status'] = "Failure";
            $response['result'] = "Old password is Required!";
        } else {
            $user_data = [
                'full_name' => $request->full_name
            ];
            User::Where('user_id', Auth::user()->user_id)->update($user_data);
            $response['status'] = "Success";
            $response['result'] = "User updated Successfully";
        }

        return response()->json($response);
    }

    public function view_form($id = null)
    {
        if ($id != null) {
            $form_data = Credential::create(['user_id' => Auth::user()->user_id, 'form_type' => 'credentialing_individual_provider', 'parent_id' => $id]);
        } else {
            $form_data = Credential::create(['user_id' => Auth::user()->user_id, 'form_type' => 'credentialing_agencies']);
        }
        return redirect()->route('view_individual_credential', ['id' => $form_data->credential_id]);
    }

    public function add_previous_provider(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->provider_credential_id!=null){
                foreach ($request->provider_credential_id as $credential_id) {
                    $credential=Credential::where('credential_id',$credential_id)->first();
                    $credential = $credential->replicate();
                    $credential->parent_id = $request->parent_id;
                    $credential->save();
                    $user_insurances = UserInsurance::where('credential_id',$credential_id)->get();
                    foreach($user_insurances as $user_insurnace){
                        if ($user_insurnace!=null){
                            $user_insurnace = $user_insurnace->replicate();
                            $user_insurnace->credential_id = $credential->credential_id;
                            $user_insurnace->save();
                        }
                    }
                    $logins=Login::where('credential_id',$credential_id)->first();
                    if ($logins!=null){
                        $logins = $logins->replicate();
                        $logins->parent_id = $request->parent_id;
                        $logins->credential_id = $credential->credential_id;
                        $logins->save();
                    }
                    $documents=CredentialingDocument::where('credential_id',$credential_id)->first();
                    if ($documents!=null){
                        $documents = $documents->replicate();
                        $documents->parent_id = $request->parent_id;
                        $documents->credential_id = $credential->credential_id;
                        $documents->save();
                    }

                    DB::commit();
                    $response['status']='success';
                    $response['result']='Added successfully';
                }
            }else{
                $response['status']='Failure';
                $response['result']='Please Select Providers!';
            }
        }catch(Exception $e){
            DB::rollBack();
            $response['status']='Failure';
            $response['result']=$e->getMessage();
        }
        return response()->json($response);


    }
    public function provider_list(Request $request){
        $provider_names=Credential::whereParentId($request->id)->pluck('provider_name')->toArray();
        $data['credential_id']=$request->id;
        $data['provider_list']=Credential::where('parent_id','!=',$request->id)
            ->whereNotIn('provider_name',$provider_names)
            ->where('form_type', 'credentialing_individual_provider')
            ->whereUserId(Auth::user()->user_id)
            ->where('provider_name','!=',null)
            ->get()
            ->unique('provider_name') ;
        return view('front_end.user.partials.provider_list',$data);
    }

    private function encrypt_password($password)
    {
        return sha1(md5($password . 'Looper$alt'));
    }

//    File Upload
    public function add_file(Request $request)
    {
        DB::disableQueryLog();
        LazyCollection::make(function () use ($request) {
            $handle = fopen($request->file, "r");
            while (($line = fgetcsv($handle, 4096)) !== false) {
                $dataString = implode(",", $line) . ',';
                $row = explode(',', $dataString);
                yield $row;
            }
            fclose($handle);
        })
            ->skip(1)
            ->chunk(1000)
            ->each(function (LazyCollection $chunk) use ($request) {
                $records = $chunk->map(function ($row) use ($request) {
                    $data = Credential::where('provider_npi', $row[0])->orWhere('group_npi', $row[0])->first();
                    if ($data != null) {
                        $credential_id = $data->credential_id;
                        $insurance_ids = explode('*', $row[1]);
                        foreach ($insurance_ids as $in_d) {
                            UserInsurance::Create([
                                "credential_id" => $credential_id,
                                "insurance_id" => $in_d
                            ]);
                        }
                    }
                })->toArray();
            });
        $response['status'] = "Success";
        $response['result'] = "successfully uploaded";
        return response()->json($response);
    }

    public function get_public_data()
    {
        $response['result'] = ContactUs::where('transferred', 0)->get();
        if (count($response['result']) > 0) {
            ContactUs::where('transferred', 0)->update(['transferred' => 1]);
        }
        return response()->json($response);
    }
}
