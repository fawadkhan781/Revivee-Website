<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AccountStatement;
use App\Models\Credential;
use App\Models\CredentialingDocument;
use App\Models\CredentialStatus;
use App\Models\DocumentStatus;
use App\Models\Insurance;
use App\Models\InsuranceTimeline;
use App\Models\Invoice;
use App\Models\ProviderPractice;
use App\Models\Receipt;
use App\Models\ReceiptInvoice;
use App\Models\InvoiceApplication;
use App\Models\Login;
use App\Models\LoginStatus;
use App\Models\ApplicationComment;
use App\Models\User;
use App\Models\UserApplication;
use App\Models\UserInsurance;
use App\Models\UserInsuranceApplicationView;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Customer extends Controller
{
    public function get_customer_details($email)
    {
        //$users = User::with('group_credential')->where('email', $email)->first();
        $users = User::where('email', $email)->first();
        $response['$users']=$users;
        $credential = [];
        if ($users) {
            $cre_ids = Credential::whereUserId($users->user_id)->get()->pluck('credential_id');
            $cre_status =  DB::table('pesrsonal_info_statuses_tab_view')
                ->select(DB::raw('sum(pesrsonal_info_statuses_tab_view.approved) as approved_count'))
                ->whereIn('credential_id',$cre_ids)->first();
            $response['cred_idds']=$cre_ids;
            $login_status = DB::table('login_statuses_tab_view')
                ->select(DB::raw('sum(login_statuses_tab_view.approved) as approved_count'))
                ->whereIn('credential_id',$cre_ids)->first();
            $doc_status = DB::table('document_status_tab_view')
                ->select(DB::raw('sum(document_status_tab_view.approved) as approved_count'))
                ->whereIn('credential_id',$cre_ids)->first();

            $approved_fields = $cre_status->approved_count + $login_status->approved_count + $doc_status->approved_count;
            $total_fields = $cre_ids->count()*32;

            $response['mark_approved'] = false;
            if($total_fields == $approved_fields){
                $response['mark_approved'] = true;
            }

            if (count($users->group_credential) > 0) {
                $credential = Credential::whereUserId($users->user_id)->where('form_type', 'credentialing_agencies')->with('provider_practices_new','provider_practices_new.provider','child_credentials')->get();
                $response['type'] = 'group';
            } else {
                $credential = Credential::with('provider_practices_new','logins', 'credential_documents', 'credential_indiviudal_status_count',
                    'credential_statuses', 'login_statuses', 'document_status')
                    ->whereUserId($users->user_id)->first();
                $response['type'] = 'individual';
            }
        }
        //$response['providers'] = Credential::with('provider_practices_new')->whereUserId($users->user_id)->orderBy('credential_id','desc')->get();
        $response['status'] = "Success";
        $response['result'] = $credential;
        return response()->json($response);
    }

    public function view_credential_group($credential_id)
    {
        $response['result'] = Credential::with('child_credentials')->whereCredentialId($credential_id)->first();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function view_credential_individual($credential_id)
    {
        $response['result'] = Credential::with('logins', 'credential_documents', 'credential_statuses', 'login_statuses', 'document_status')->whereCredentialId($credential_id)->first();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function get_new_insurances_application($role,$userid)
    {
        if($role == 3){
            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->where('assign_to', $userid)->where('insurance_status', 'Pending')->orderBy('id', 'DESC')->get();
        }else{
            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->where('insurance_status', 'Pending')->orderBy('id', 'DESC')->get();
        }
        $response['status'] = 'success';
        return response()->json($response);
    }

    //get records by Scrolling
    public function get_insurances_app_scroll($page)
    {
        $records = $page;
        if ($records == 0) {
            $response['result'] = UserInsurance::with('insurance', 'credential', 'insurance_timeline')
                ->whereHas('credential', function ($query) {
                    $query->where('form_type', 'credentialing_individual_provider');
                })
                ->orderBy('id', 'DESC')
                ->take(20)
                ->get();
        } else {
            $response['result'] = UserInsurance::with('insurance', 'credential', 'insurance_timeline')
                ->whereHas('credential', function ($query) {
                    $query->where('form_type', 'credentialing_individual_provider');
                })
                ->orderBy('id', 'DESC')
                ->skip($records)
                ->take(500)
                ->get();
        }

        $response['status11'] = $page;
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function get_insurances_application_timeline_detail($user_application_id)
    {
        $response['timelines'] = InsuranceTimeline::with('user_application')
            ->where('user_application_id', $user_application_id)->orderBy('id', 'DESC')->get();
        $user_insurance = UserApplication::with('insurance')->where('id', $user_application_id)->first();
        $response['insurance_details'] = UserApplication::with('insurance')->where('credential_id', $user_insurance->credential_id)->get();
        $response['provider_info'] = Credential::with('logins', 'credential_documents',
            'credential_statuses', 'login_statuses', 'document_status')
            ->where('credential_id', $response['insurance_details'][0]->credential_id)->first();
        $public_user = User::with('group_credential')->where('user_id', $response['provider_info']->user_id)->first();
        $response['user_insurance'] = $user_insurance;
        $user_insurance_list = UserInsuranceApplicationView::with('insurance','user')
            ->whereUserId($user_insurance->user_id)
            ->orderBy('app_count', 'DESC')
            ->get();
        $credential = [];
        if ($public_user) {
            if (count($public_user->group_credential) > 0) {
                $credential = Credential::whereUserId($public_user->user_id)->where('form_type', 'credentialing_agencies')->with('child_credentials')->get();
                $response['type'] = 'group';
            } else {
                $credential = Credential::with('logins', 'credential_documents', 'credential_indiviudal_status_count',
                    'credential_statuses', 'login_statuses', 'document_status')
                    ->whereUserId($public_user->user_id)->first();
                $response['type'] = 'individual';
            }
        }
        $response['customres_info'] = $credential;
        $response['status'] = 'success';
        $response['user_insurance_list'] = $user_insurance_list;
        $response['public_user'] = $public_user;
        return response()->json($response);
    }

    public function app_search_query_by_title(Request $request)
    {
        $credential_ids = Credential::where('provider_name', 'LIKE', '%' . $request->title . '%')->pluck('credential_id')->toArray();
        $insurance_ids = Insurance::where('title', 'LIKE', '%' . $request->title . '%')->pluck('id')->toArray();
        $response['result'] = UserApplication::with('user','insurance', 'credential', 'insurance_timeline')
            ->where(function ($query) use ($credential_ids,$insurance_ids){
                $query->orWhereIn('credential_id',$credential_ids);
                $query->orWhereIn('insurance_id',$insurance_ids);
            })
            ->orderBy('id', 'DESC')
            ->get();
        $response['status'] = 'success';
        return response()->json($response);
    }

    public function app_search_new_and_assign_list(Request $request)
    {
        $tab = $request->tab;
        if($tab == 'pending') {
            $un_assign_users = User::where('credential_assign',NULL)->pluck('user_id')->toArray();
            if($request->filter == 'pending_filter'){
                $credential_ids = [];
                $app_ids = UserApplication::where('insurance_status', 'Pending');
                if($request->insurance_id != null || $request->insurance_id != ''){
                    $app_ids = $app_ids->where('insurance_id',$request->insurance_id);
                }
                if($request->npi != null || $request->npi != ''){
                    $credential_ids = Credential::where( function ($query) use ($request){
                        $query->orWhere('group_npi',$request->npi);
                        $query->orWhere('provider_npi',$request->npi);
                    })->pluck('credential_id')->toArray();
                    $app_ids = $app_ids->whereIn('credential_id',$credential_ids);
                }
                $app_ids = $app_ids->pluck('id')->toArray();
            }else{
                $credential_ids = Credential::
                where( function ($query) use ($request){
                    $query->orWhere('provider_name', 'LIKE', '%' .$request->search_string. '%');
                    $query->orWhere('group_name', 'LIKE', '%' .$request->search_string. '%');
                })
                    ->pluck('credential_id')->toArray();
                $insurances = Insurance::where('title', 'LIKE', '%' . $request->search_string . '%')->pluck('id')->toArray();
                $app_ids = UserApplication::where('insurance_status', 'Pending')
                    ->where( function ($query) use ($insurances,$credential_ids){
                        $query->orWhereIn('credential_id',$credential_ids);
                        $query->orWhereIn('insurance_id',$insurances);
                    })->pluck('id')->toArray();

            }
            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->whereIn('id',$app_ids)
                ->orderBy('id', 'DESC')->get();
            $response['type'] = 'pending';
        }
        else {
            if($request->role == 'agent'){
                $assign_users = User::where('credential_assign',$request->auth_user)->pluck('user_id')->toArray();
            } else {
                $assign_users = User::where('credential_assign','!=', NULL)->pluck('user_id')->toArray();
            }
            if($request->filter == 'submitted_filter'){
                $app_ids = UserApplication::with('insurance' )->where('insurance_status', '!=', 'Pending');
                if($request->insurance_id != null || $request->insurance_id != ''){
                    $app_ids = $app_ids->where('insurance_id',$request->insurance_id);
                }

                if($request->insurance_status != null || $request->insurance_status != ''){
                    $app_ids = $app_ids->where('insurance_status', $request->insurance_status);
                }

                if($request->assigned_to != null || $request->assigned_to != ''){
                    $app_ids = $app_ids->where('assign_to', $request->assigned_to);
                }
                $credential_ids = [];
                if($request->npi !=null || $request->npi != ''){
                    $credential_ids = Credential::
                    where( function ($query) use ($request){
                        $query->orWhere('group_npi',$request->npi);
                        $query->orWhere('provider_npi',$request->npi);
                    })->pluck('credential_id')->toArray();
                    $app_ids = $app_ids->whereIn('credential_id',$credential_ids);
                }
                $app_ids = $app_ids->pluck('id')->toArray();
            }
            else {
                $credential_ids = Credential::where( function ($query) use ($request){
                    $query->orWhere('provider_name', 'LIKE', '%' .$request->search_string. '%');
                    $query->orWhere('group_name', 'LIKE', '%' .$request->search_string. '%');
                })
                    ->pluck('credential_id')->toArray();
                $insurances = Insurance::where('title', 'LIKE', '%' . $request->search_string . '%')->pluck('id')->toArray();
                $app_ids = UserApplication::where( function ($query) use ($insurances,$credential_ids){
                    $query->orWhereIn('credential_id',$credential_ids);
                    $query->orWhereIn('insurance_id',$insurances);
                })->pluck('id')->toArray();
            }

            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->whereIn('id',$app_ids)->where('insurance_status', '!=', 'Pending')
                ->orderBy('id', 'DESC')->get();
            $response['type'] = 'submitted';
        }
        $response['status'] = 'success';
        $response['all'] = $request->all();
        return response()->json($response);
    }

    // get Assigned insurances against Auth user
    public function get_app_assigned_insurances(Request $request)
    {
        if($request->role == 'agent'){
            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->where('insurance_status', '!=', 'Pending')
                ->where('assign_to', $request->auth_user)
                ->get();
        } else {
            $response['result'] = UserApplication::with('user', 'insurance', 'credential', 'insurance_timeline')
                ->where('insurance_status', '!=', 'Pending')
                ->get();
        }
        $response['status'] = 'success';
        return response()->json($response);
    }

    //update credential_assign in User against User Email (Request from RCM-CRM)

    public function credential_assign_to(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'credential_assign_to' => 'required',
            'email' => 'required',
        ]);
        if ($validator->passes()) {
            User::where('email', $request->email)->update(['credential_assign' => $request->credential_assign_to]);
            $response['email'] = $request->email;
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Failure';
        }
        return response()->json($response);
    }

    public function get_agent_assigned_insurances($agent_id)
    {
        $users_id = User::where('credential_assign', $agent_id)->get()->pluck('user_id')->toArray();
        $credentials_id = Credential::whereIn('user_id', $users_id)->get()->pluck('credential_id')->toArray();
        $insurance_ids = UserInsurance::whereIn('credential_id', $credentials_id)->get()->pluck('insurance_id')->toArray();
        $insurance_count = count($insurance_ids);
        $insurance_list = DB::table('user_insurances')
            ->select(DB::raw('user_insurances.insurance_id as insurance_id,
            count(user_insurances.insurance_id) as insurance_count, insurances.title as title',
            ))
            ->join('insurances','insurances.id', '=', 'user_insurances.insurance_id')
            ->whereIn('user_insurances.insurance_id',$insurance_ids)
            ->groupBy('user_insurances.insurance_id')
            ->get();

        $insurance_status = DB::table('user_insurances')->select(DB::raw('
            ANY_VALUE(user_insurances.insurance_id) as insurance_id, 
            ANY_VALUE(user_insurances.insurance_status) as insurance_status,
            count(user_insurances.insurance_status) as status_count
        '))
            ->whereIn('user_insurances.insurance_id',$insurance_ids)
            ->groupBy('user_insurances.insurance_status')
            ->get();
        $response['insurance_count'] = $insurance_count;
        $response['insurance_status_list'] = $insurance_status;
        $response['insurance_list'] = $insurance_list;
        $response['status'] = 'success';
        return response()->json($response);
    }

    //update partial customer info (Request from RCM-CRM)
    public function update_partial_customer_info_lead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'rate_per_application' => 'required',
            'allowable_payment' => 'required',
        ]);
        if ($validator->passes()) {
            $updates = [
                'rate_per_application' => $request->rate_per_application,
                'allowable_payment' => $request->allowable_payment,
            ];
            if (!empty($request->business_name)) {
                $updates['business_name'] = $request->business_name;
            }
            User::where('email', $request->email)->update($updates);
            //User::where('email', $request->email)->update(['rate_per_application' => $request->rate_per_application, 'allowable_payment' => $request->allowable_payment]);
            $response['email'] = $request->email;
            $response['status'] = 'success';
        } else {
            $response['status'] = 'Failure';
        }
        return response()->json($response);
    }
    public function user_app_list($email)
    {
        try{
            if($email){
                $user = User::where('email', $email)->firstOrFail();
                if($user){
                    $credentials =  Credential::where('user_id', $user->user_id)->get()->pluck('credential_id')->toArray();
                    $userApplications = UserApplication::with('insurance','credential')
                        ->where('is_paid', 0)
                        ->whereIn('credential_id', $credentials)
                        ->get();
                }
                return response()->json(['status' => 'success', 'result' => $userApplications], 200);
            }else{
                $response['result'] = [];
                $response['status'] = 'failure';
            }
            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // add new group info
    public function add_new_group_info(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'credential_type' => 'required',
        ]);
        if ($validator->passes()) {
            $user = User::where('email', $request->email)->first();
            DB::beginTransaction();
            try {
                $personal_info_data = [
                    'form_type' => $request->credential_type,
                    'user_id' => $user->user_id,
                ];
                $form_data = Credential::create($personal_info_data);
                $credential_id = $form_data->credential_id;
                $credential_info_data = [
                    'user_id' => $user->user_id,
                    'credential_id' => $credential_id,
                ];
                Login::create($credential_info_data);
                CredentialingDocument::create($credential_info_data);
                $response['status'] = 'Success';
                $response['result'] = 'Details Done';

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $response['status'] = "Failure";
                $response['result'] = $e->getMessage();
            }
        } else {
            $response['status'] = 'Failure';
        }
        return response()->json($response);
    }

    public function add_new_group_individual_info(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'credential_type' => 'required',
            'credential_id' => 'required',
        ]);
        if ($validator->passes()) {
            $user = User::where('email', $request->email)->first();
            DB::beginTransaction();
            try {
                $personal_info_data = [
                    'form_type' => $request->credential_type,
                    'user_id' => $user->user_id,
                    'parent_id' => $request->credential_id,
                ];
                $form_data = Credential::create($personal_info_data);
                $credential_id = $form_data->credential_id;
                $credential_info_data = [
                    'user_id' => $user->user_id,
                    'credential_id' => $credential_id,
                    'parent_id' => $request->credential_id,
                ];
                $provider_practice_data = [
                    'provider_id' => $credential_id,
                    'practice_id' => $request->credential_id,
                ];
                Login::create($credential_info_data);
                CredentialingDocument::create($credential_info_data);
                ProviderPractice::updateOrCreate($provider_practice_data);
                $response['status'] = 'Success';
                $response['info'] = $personal_info_data;
                $response['result'] = 'Details Done';

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $response['status'] = "Failure";
                $response['result'] = $e->getMessage();
            }
        } else {
            $response['status'] = 'Failure';
        }
        return response()->json($response);
    }
    public function add_new_group_individual_info_old_not_In_used(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'credential_type' => 'required',
            'credential_id' => 'required',
        ]);
        if ($validator->passes()) {
            $user = User::where('email', $request->email)->first();
            DB::beginTransaction();
            try {
                $personal_info_data = [
                    'form_type' => $request->credential_type,
                    'user_id' => $user->user_id,
                    'parent_id' => $request->credential_id,
                ];
                $form_data = Credential::create($personal_info_data);
                $credential_id = $form_data->credential_id;
                $credential_info_data = [
                    'user_id' => $user->user_id,
                    'credential_id' => $credential_id,
                    'parent_id' => $request->credential_id,
                ];
                Login::create($credential_info_data);
                CredentialingDocument::create($credential_info_data);
                $response['status'] = 'Success';
                $response['info'] = $personal_info_data;
                $response['result'] = 'Details Done';

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $response['status'] = "Failure";
                $response['result'] = $e->getMessage();
            }
        } else {
            $response['status'] = 'Failure';
        }
        return response()->json($response);
    }

    public function get_customer_insurances($public_user_id,$email)
    {
        $public_user = User::where(function ($q) use ($public_user_id, $email){
            $q->orWhere('user_id', $public_user_id);
            $q->orWhere('email', $email);
        })->first();
        $user_insurances = UserInsurance::where('user_id', $public_user->user_id)
            ->where('status', 1)
            ->pluck('insurance_id')->toArray();
        $user_insurance_list = UserInsuranceApplicationView::with('insurance','user')
            ->whereUserId($public_user->user_id)
            ->whereIn('insurance_id', $user_insurances)
            ->orderBy('app_count', 'DESC')
            ->get();
        $insurance_ids = $user_insurance_list->pluck('insurance_id')->toArray();
        $insurance_list = Insurance::where('status', 1)->whereNotIn('id', $insurance_ids)->get();

        $response['status'] = 'Success';
        $response['user_insurance_list'] = $user_insurance_list;
        $response['insurance_list'] = $insurance_list;
        $response['public_user'] = $public_user;
        $response['result'] = 'Details Done';
        return response()->json($response);
    }

    public function add_customer_insurances(Request $request){
        $public_user = User::where(function ($q) use ($request){
            $q->orWhere('user_id', $request->user_id);
            $q->orWhere('email', $request->email);
        })->first();
        if($request->selectedInsurances){
            foreach ($request->selectedInsurances as $user_insurance){
                UserInsurance::create(
                    [
                        'user_id' => $public_user->user_id,
                        'insurance_id' => $user_insurance['insurance_id'],
                        'added_on' => date('Y-m-d H:i:s'),
                        'added_by' => $request->agent_id,
                        'status' => 1
                    ]
                );
            }
        }
        $user_insurance_list = UserInsuranceApplicationView::with('insurance','user')->whereUserId($public_user->user_id)->get();
        $insurance_ids = $user_insurance_list->pluck('insurance_id')->toArray();
        $insurance_list = Insurance::whereNotIn('id', $insurance_ids)->get();
        $response['status'] = 'Success';
        $response['user_insurance_list'] = $user_insurance_list;
        $response['insurance_list'] = $insurance_list;
        $response['public_user'] = $public_user->user_id;
        return response()->json($response);
    }

    public function get_customer_provider($user_id, $email, $insurance_id)
    {
        $public_user = User::where(function ($q) use ($user_id, $email){
            $q->orWhere('user_id', $user_id);
            $q->orWhere('email', $email);

        })->first();
        $applied_provider = UserApplication::where('insurance_id', $insurance_id)
            ->pluck('credential_id')->toArray();
        $providers = Credential::whereUserId($public_user->user_id)->whereNotIn('credential_id',$applied_provider)->get();
        $selected_providers = UserApplication::with('credential')
            ->where('insurance_id', $insurance_id)
            ->where('user_id', $public_user->user_id)
            ->whereIn('credential_id',$applied_provider)
            ->get();
        $response['status'] = 'Success';
        $response['selected_providers'] = $selected_providers;
        $response['providers'] = $providers;
        return response()->json($response);
    }
    public function add_customer_insurance_application(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'insurance_id' => 'required',
            'providers' => 'required',
        ]);
        //check
        if ($validator->fails()) {
            $response['status'] = 'Failure';
            $response['result'] = $validator->errors()->first();
            return response()->json($response);
        }

        $providers = explode(',', $request->providers);

        foreach ($providers as $provider) {
            $ua = UserApplication::updateOrCreate(
                [
                    'credential_id' => $provider,
                    'insurance_id' => $request->insurance_id
                ],
                [
                    'insurance_status' => 'Pending',
                    'user_id' => $request->user_id,
                    'last_update_date' => eastern_date_time(),
                    'up_coming_date' => date('Y-m-d H:i:s', strtotime(eastern_date_time() . "+10 days")),
                    'is_read' => 0
                    //'assign_to' =>  $request->assign_to,
                    // 'agent_name' => $request->agent_name,

                ]
            );
        }

        $response['status'] = 'Success';
        $response['result'] = 'Added Successfully';
        $response['all_data'] = $request->all();
        $response['user_applications'] = $ua;

        return response()->json($response);
    }

    public function remove_provider_from_application(Request $request)
    {
        UserApplication::where('credential_id', $request->credential_id)
            ->where('insurance_id', $request->insurance_id)->delete();
        $applied_provider = UserApplication::where('insurance_id', $request->insurance_id)
            ->pluck('credential_id')->toArray();
        $providers = Credential::whereUserId($request->user_id)->whereNotIn('credential_id',$applied_provider)->get();
        //$selected_providers = Credential::whereUserId($request->user_id)->whereIn('credential_id',$applied_provider)->get();
        $selected_providers = UserApplication::with('credential')
            ->where('insurance_id', $request->insurance_id)
            ->where('user_id', $request->user_id)
            ->whereIn('credential_id',$applied_provider)
            ->get();
        $response['status'] = 'Success';
        $response['selected_providers'] = $selected_providers;
        $response['providers'] = $providers;
        return response()->json($response);
    }

    public function get_customer_stats($public_user_id,$email)
    {
        $public_user = User::where(function ($q) use ($public_user_id, $email){
            $q->orWhere('user_id', $public_user_id);
            $q->orWhere('email', $email);
        })->first();
        $total_insurances = UserInsurance::where('user_id', $public_user->user_id)->count();
        $total_app = UserApplication::where('user_id', $public_user->user_id)->count();
        $app_stats = DB::table('user_applications')
            ->select(DB::raw(' user_id,insurance_status, COUNT(id) AS count'))
            ->where('user_id', $public_user->user_id)
            ->groupBy('user_id', 'insurance_status')->get();
        $response['status'] = 'Success';
        $response['total_insurances'] = $total_insurances;
        $response['public_user'] = $public_user;
        $response['app_stats'] = $app_stats;
        $response['total_app'] = $total_app;
        return response()->json($response);
    }
    public function get_payment_stats($user_id){
        $response['payment'] = AccountStatement::select(DB::raw('type, SUM(total_amount) AS total_amount'))
            ->where('user_id', $user_id)
            ->groupBy('type')
            ->get();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function add_assigned_credentials(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'application_id' => 'required',
            'assign_to' => 'required',
            'agent_name' => 'required',
        ]);

        $application = UserApplication::find($validatedData['application_id']);

        if ($application) {
            $application->assign_to = $validatedData['assign_to'];
            $application->agent_name = $validatedData['agent_name'];
            $application->save();

            $response['status'] = 'success';
            $response['result'] = "Credentials assigned successfully";

        } else {
            $response['status'] = 'failure';
            $response['result'] = "Application not found";
        }
        return response()->json($response);
    }

    public function add_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'application_id' => 'required',
            'comment' => 'required',
        ]);
        //check
        if ($validator->passes()){
            ApplicationComment::create([
                'application_id' => $request->application_id,
                'comment' => $request->comment,
                'added_on' => date('Y-m-d H:i:s'),
                'added_by_name' => $request->added_by_name,
            ]);
        } else {
            $response['status'] = 'Failure';
            $response['result'] = $validator->errors()->first();
            return response()->json($response);
        }
        $response['status'] = 'Success';
        $response['result'] = 'Added Successfully';

        return response()->json($response);
    }

    public function get_comments($application_id){
        $response['comments'] = ApplicationComment::where('application_id', $application_id)->orderBy('id', 'DESC')->get();
        $response['status'] = 'Success';
        return response()->json($response);
    }
    public function remove_customer_insurances(request $request){
        $userInsurance = UserInsurance::find($request->id);
        if ($userInsurance) {
            $userInsurance->update(['status' => 0]);
            return response()->json(['status' => 'Success', 'message' => 'Insurance removed successfully']);
        } else {
            return response()->json(['status' => 'Failure', 'message' => 'Insurance not found'], 404);
        }
    }
    public function add_customer_invoice(request $request){

        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                'user_id' => $request->public_user_id,
                'title' => $request->title,
                'due_date' => $request->due_date,
                'total_amount' => $request->total_amount,
                'discount' => $request->discount,
                'added_by' => $request->added_by,
                'added_by_name' => $request->added_by_name,
                'added_on' => date('Y-m-d H:i:s'),
            ]);
            $selected_applications = explode(',', $request->selected_application);
            foreach ($selected_applications as $app_id) {
                UserApplication::where('id', $app_id)->update(['is_paid' => 1]);
                $ia = InvoiceApplication::create([
                    'invoice_id' => $invoice->invoice_id,
                    'application_id' => $app_id
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        $response['status'] = 'Success';
        $response['request all'] = $request->all();
        return response()->json($response);
    }
    public function delete_customer_invoice(Request $request){
        try {
            $invoice = Invoice::where('invoice_id', $request->invoice_id)->first();
            if ($invoice) {
                $invoice->status = 0;
                $invoice->save();
                $response['status'] = 'success';
                $response['result'] = 'Invoice Deleted Successfully';
            } else {
                $response['status'] = 'Failure';
                $response['result'] = 'Invoice not found';
            }
        } catch (\Exception $e) {
            $response['status'] = 'Failure';
            $response['result'] = 'An error occurred: ' . $e->getMessage();
        }
        return response()->json($response);
    }
    public function delete_customer_receipt(Request $request)
    {
        try {
            $receipt = Receipt::where('receipt_id', $request->receipt_id)
                ->where('invoice_id', $request->invoice_id)->first();
            if ($receipt) {
                $receipt->status = 0;
                $receipt->save();
                $response['status'] = 'success';
                $response['result'] = 'Receipt Deleted Successfully';
            } else {
                $response['status'] = 'Failure';
                $response['result'] = 'Receipt not found';
            }
        } catch (\Exception $e) {
            $response['status'] = 'Failure';
            $response['result'] = 'An error occurred: ' . $e->getMessage();
        }
        return response()->json($response);
    }
    public function add_customer_receipt(request $request){
        DB::beginTransaction();
        try {
            $request_data = json_decode($request->getContent(), true);

            // Validate the data
            $validator = Validator::make($request_data, [
                'user_id' => 'required',
                'title' => 'required',
                'total_amount' => 'required',
                'invoice_id' => 'required',
                'customer_id' => 'required',
                'added_by' => 'required',
                'remaining_due' => 'required',
            ]);

            if ($validator->passes()) {
                $receipt = Receipt::create([
                    'title' => $request_data['title'],
                    'user_id' => $request_data['user_id'],
                    'invoice_id' => $request_data['invoice_id'],
                    'customer_id' => $request_data['customer_id'],
                    'total_amount' => $request_data['total_amount'],
                    'receipt_date' => get_date_time(),
                    'added_by' =>  $request_data['added_by'],
                    'added_by_name' =>  $request_data['added_by_name'],
                    'added_on' => get_date_time(),
                    'payment_status' =>  $request_data['remaining_due'] > 0 ? 'partial' : 'paid',
                ]);


                if ($request_data['remaining_due'] == 0) {
                    // Update paid status in UserApplication
                    //UserApplication::where('user_id', $request_data['user_id'])->update([
                    // 'is_paid' => 1,
                    //  'last_update_date' => get_date_time(),
                    //]);
                    // Update paid status in Invoice
                    Invoice::where('invoice_id', $request_data['invoice_id'])
                        ->where('user_id', $request_data['user_id'])
                        ->update([
                            'is_paid' => 1,
                            'modified_on' => get_date_time(),
                            'modified_by' => $request_data['added_by'],
                            'modified_by_name' => $request_data['added_by_name'] ?? null,
                        ]);
                }

                $response = [
                    "status" => "Success",
                    "result" => "Add Receipt Details Successfully",
                ];
            } else {
                $response = [
                    'status' => "Failure!",
                    'result' => $validator->errors()->toJson(),
                ];
            }
            DB::commit();
        } catch (\Exception $e) {
            $response = [
                'status' => 'Failure!',
                'result' => $e->getMessage(),
            ];
            DB::rollBack();
        }

        return response()->json($response);
    }
    public function customer_account_statement_detail(Request $request) {
        $validator = Validator::make($request->all(), [
            //'customer_id' => 'required',
            'type' => 'required',
            'id' => 'required'
        ]);

        $response = [];

        if ($validator->passes()) {
            //$response['customer'] = Customer::with('invoices','receipts')->where('customer_id', $request->customer_id)->first();
            $response['statement'] = AccountStatement::where('id', $request->id)
                ->where('type', $request->type)
                ->first();
            if ($request->type === 'Invoice') {
                $response['statement_detail'] = Invoice::where('invoice_id', $request->id)->get();
            } else {
                $response['statement_detail'] = Receipt::where('receipt_id', $request->id)->get();
            }
            $response['status'] = "Success";
        } else {
            $response['status'] = "Failure";
            $response['result'] = $validator->errors()->toJson();
        }

        return response()->json($response);
    }
    //unpaid invoices
    public function get_unpaid_invoice_for_receipt($user_id){
        try {
            if (!is_numeric($user_id) || $user_id <= 0) {
                throw new \InvalidArgumentException('Invalid user ID');
            }
            $unpaid_invoices = Invoice::with(['receipts' => function ($query) {
                $query->where('payment_status', 'partial')->where('status', 1);
            }])->where('user_id', $user_id)->where('is_paid', 0)->where('status', 1)->get();
            //$unpaid_invoices = Invoice::with('receipts')->where('user_id', $user_id)->where('is_paid', 0)->get();
            $response['unpaid_invoices'] = $unpaid_invoices;
            $response['status'] = 'Success';
            return response()->json($response);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'Failure',
                'message' => $e->getMessage(),
            ];
            return response()->json($errorResponse, 400);
        }
    }

    public function customer_assigned_to_credential(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'credential_id' => 'required',
                'form_type' => 'required',
                'credential_assign_to' => 'required',
                'credential_assign_name' => 'required',
            ]);

            $credentialExists = Credential::where('credential_id', $request->credential_id)->exists();
            if (!$credentialExists) {
                throw new \Exception('Credential not found');
            }

            Credential::where('credential_id', $request->credential_id)
                ->where('form_type', $request->form_type)
                ->update([
                    'credential_assign' => $request->credential_assign_to,
                    'credential_assign_name' => $request->credential_assign_name,
                    'modified_on' => get_date_time(),
                ]);

            $response['status'] = 'success';
            $response['result'] = 'Credentials Assigned successfully';
            return response()->json($response);
        } catch (\Exception $e) {
            $response['status'] = 'Failure';
            $response['result'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function customer_finance_details(Request $request)
    {
        //$request->customer_id mean public user id
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
        if ($validator->passes()) {
            //$response['invoices'] = Invoice::with('user','receipts')->whereUserId($request->customer_id)->get();

            $query_invoice = Invoice::with(['user' => function ($query) use ($request) {
                $query->where('user_id', '=', $request->customer_id);
            }])->with('receipts')->whereUserId($request->customer_id);
            $response['invoices'] = $query_invoice->get();

            $response['receipts'] = Receipt::with('receipt_added_by','receipt_invoice_details.invoice')->whereUserId($request->customer_id)->get();
            $response['unpaid_invoices'] = Invoice::doesntHave('invoice_receipt')->whereUserId($request->customer_id)->get();

            $query=AccountStatement::whereUserId($request->customer_id);
            $response['account_statements'] = $query->orderBy('added_on','desc')->get();

            $response['total_receipt'] = $query->whereType('Receipt')->get();
            $response['total_invoice'] = AccountStatement::whereUserId($request->customer_id)->whereType('Invoice')->get();

            $response['status'] = 'success';
        }else{
            $response['status']='Failure2';
            $response['result']= 'Requested Field are required';
        }
        return response()->json($response);

    }
    public function customer_docs_upload(Request $request)
    {
        try {
            $docs_upload_files = [];
            $docs_upload_response = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $docs_upload_files[] = $name;
                    $docs_upload_response[] = $file;
                }
            }

            $new_docs_upload_files = implode(',', $docs_upload_files);
            $existingDocument = null;

            if ($request->credential_doc_status == 'updateDocument') {
                $existingDocument = CredentialingDocument::where(['id' => $request->id, 'credential_id' => $request->credential_id])->first();
                if ($existingDocument) {
                    $currentValue = $existingDocument->{$request->image_name};
                    if ($currentValue !== null && $currentValue !== '') {
                        $existingDocument->{$request->image_name} .= ',' . $new_docs_upload_files;
                    } else {
                        $existingDocument->{$request->image_name} = $new_docs_upload_files;
                    }
                    $existingDocument->save();
                }
            } else {
                CredentialingDocument::create(['credential_id' => $request->credential_id, $request->image_name => $new_docs_upload_files]);
            }

            $response['status'] = "Success";
            $response['all_response'] = $existingDocument;
            $response['request_data'] = $request->all();
            $response['docs_upload_response'] = $docs_upload_response;
            $response['files_image'] = $request->file('files');
            $response['result'] = 'Documents Added Successfully!';
        } catch (\Exception $e) {
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }

        return response()->json($response);
    }

    public function remove_customer_docs(Request $request)
    {
        try {
            $imageNames = explode(',', $request->image_name);
            $credentialDocument = CredentialingDocument::find($request->id);
            $currentImages = '';

            if ($credentialDocument) {
                $columnName = $request->col_name;
                if (in_array($columnName, $credentialDocument->getFillable()) && !empty($credentialDocument->$columnName)) {
                    $currentImages = explode(',', $credentialDocument->$columnName);
                    $updatedImages = array_diff($currentImages, $imageNames);
                    $credentialDocument->$columnName = implode(',', $updatedImages);

                    // Delete files from the folder also
                    foreach ($imageNames as $imageName) {
                        $filePath = public_path('credential_images') . '/' . $imageName;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
                $credentialDocument->save();
                $response['$request->id_send'] = $request->id;
                $response['$columnName_get'] = $credentialDocument->$columnName;
                $response['column_request_send'] = $request->col_name;
                $response['$imageNames_send'] = $imageNames;
                $response['$currentImages'] = $currentImages;
                $response['status'] = "success";
                $response['result'] = "Removed successfully";
            }

        } catch (\Exception $e) {
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }
    public function add_any_documents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'Failure', 'result' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        try {
            $filePaths = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $name = time() . '_' . uniqid() . '.' . $file->extension();
                    $file->move(public_path('credential_images'), $name);
                    $filePaths[] = $name;
                }
            }
            $docsFiles = implode(',', $filePaths);

            /* $document = Document::create([
                 'title' => $request->title,
                 'docs_files' => $docsFiles,
                 'added_on' => get_date_time(),
                 'added_by' => $request->user_id,
             ]);*/

            UserDocument::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'docs_files' => $docsFiles,
                'added_on' => get_date_time(),
                'added_by' => $request->added_by,
                'added_by_name' => $request->added_by_name,
            ]);

            $response['status'] = 'Success';
            $response['result'] = 'Document Added Successfully!';
            $response['all_req'] = $request->file('files');
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Failure', 'result' => $e->getMessage()], 500);
        }
    }

    public function get_any_customer_docs($user_id)
    {
        try {
            $userDocuments = UserDocument::where('user_id', $user_id)->orderBy('added_on','desc')->get();

            $response['status'] = 'Success';
            $response['result'] = $userDocuments;
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Failure', 'result' => $e->getMessage()], 500);
        }
    }

    public function add_insurance_timeline_react(Request $request)
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
    public function login_form_update_react(Request $request)
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

    public function personal_form_update_react(Request $request)
    {
        $serviceAddresses = $request->input('service_address');
        $commaSeparatedAddresses = implode(', ', $serviceAddresses);

        $form_data = Credential::where('credential_id', $request->credential_id)
            ->where('form_type', $request->form_type)
            ->first();
        $allowedFields = [];
        if($request->form_type == 'credentialing_individual_provider'){
            $allowedFields = ['provider_name', 'provider_npi', 'ssn_number', 'specialty','owner_dob', 'license_number','home_address', 'uhc_portal'];
        }else{
            $allowedFields = ['group_name', 'group_npi', 'group_tax_id', 'specialty', 'service_address', 'mailing_address', 'billing_mailing_address', 'practice_phone', 'practice_fax', 'email', 'business_hours'];
        }

        // array for only allowed and non-null fields
        $updateData = [];
        foreach ($request->all() as $field => $value) {
            if (!is_null($value) && in_array($field, $allowedFields)) {
                $updateData[$field] = ($field == 'service_address') ? $commaSeparatedAddresses : $value;
                //$updateData[$field] = $value;
            }
        }

        $form_data->update($updateData);

        $response['result'] = 'Personal Info updated Successfully';
        $response['status'] = "Success";
        return response()->json($response);
    }

    public function form_status_react(Request $request)
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

    public function personal_form_update_react_old_code(Request $request)
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
                'start_date' => $request->start_date,
                'group_tax_id' => $request->group_tax_id,
                'specialty' => $request->specialty,
                'mailing_address' => $request->mailing_address,
                'practice_phone' => $request->practice_phone,
                'practice_fax' => $request->practice_fax,
                'email' => $request->email,
                'business_hours' => $request->business_hours,
                'license_number' => $request->license_number
            ]);
        $response['result'] = 'Personal Info updated Successfully';
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function create_new_user_rcm_api(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'full_name' => $request->full_name,
                    'customer_id' => $request->customer_id,
                    'rate_per_application' => $request->rate_per_application,
                    'allowable_payment' => $request->allowable_payment,
                    'password' => Hash::make($request->password),
                    'business_name' => $request->business_name,
                    'role_id' => 2,
                    'modified_on' => date('Y-m-d H:i:s'),
                ]
            );

            $response = [
                'status' => 'Success',
                'user_id' => $user->user_id,
                'result' => 'User added successfully',
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 'Error',
                'result' => $e->getMessage(),
            ];
        }
        $response['datafrom'] = $request->all();
        return response()->json($response);
    }

    // encrypt password
    private function encrypt_password($password)
    {
        return sha1(md5($password . 'Looper$alt'));
    }

}