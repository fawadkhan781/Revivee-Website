<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\AccountStatement;
use App\Models\Credential;
use App\Models\CredentialingDocument;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\Login;
use App\Models\ProviderPractice;
use App\Models\Receipt;
use App\Models\User;
use App\Models\UserApplication;
use App\Models\UserCard;
use App\Models\UserDocument;
use App\Models\UserInsurance;
use App\Models\InvoiceStatementCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return $request->user();
    }
    public function getUserInfo()
    {
        $users = User::with('group_credential')->where('user_id', Auth::user()->user_id)->first();
        if ($users) {
            $cre_ids = Credential::whereUserId($users->user_id)->get()->pluck('credential_id');

            $cre_status = DB::table('pesrsonal_info_statuses_tab_view')
                ->select(DB::raw('sum(pesrsonal_info_statuses_tab_view.approved) as approved_count'))
                ->whereIn('credential_id', $cre_ids)->first();
            $login_status = DB::table('login_statuses_tab_view')
                ->select(DB::raw('sum(login_statuses_tab_view.approved) as approved_count'))
                ->whereIn('credential_id', $cre_ids)->first();
            $doc_status = DB::table('document_status_tab_view')
                ->select(DB::raw('sum(document_status_tab_view.approved) as approved_count'))
                ->whereIn('credential_id', $cre_ids)->first();

            $approved_fields = $cre_status->approved_count + $login_status->approved_count + $doc_status->approved_count;
            $total_fields = $cre_ids->count() * 32;

            $response['mark_approved'] = false;
            if ($total_fields == $approved_fields) {
                $response['mark_approved'] = true;
            }

            $response['practices'] = Credential::with('credential_documents', 'logins', 'credential_group_status_count')
                ->whereUserId($users->user_id)
                ->where('form_type', 'credentialing_agencies')
                ->orderBy('credential_id','desc')
                ->get();

            $response['providers'] = Credential::with(
                'provider_practices', 'logins', 'credential_documents', 'credential_indiviudal_status_count')
                ->where('form_type', 'credentialing_individual_provider')
                ->whereUserId($users->user_id)
                ->orderBy('credential_id','desc')
                ->get();
            $response['payers'] = UserInsurance::with('insurance')->whereUserId($users->user_id)->get();
            $response['insurances'] = Insurance::whereNotIn('id', $response['payers']->pluck('insurance_id')->toArray())->get();
            $response['status'] = "Success";
            $response['user'] = Auth::user();
            return response()->json($response);
        }
    }
    public function updatePersonalInfo(Request $request){

        $serviceAddresses = $request->input('service_address');
        $commaSeparatedAddresses = implode(', ', $serviceAddresses);

        $item = Credential::updateOrCreate(
            [
                'credential_id' => $request->credential_id
            ],
            [
                'user_id' => Auth::user()->user_id,
                'form_type' => $request->form_type,
                'group_name' => $request->group_name,
                'group_npi' => $request->group_npi,
                'group_tax_id' => $request->group_tax_id,
                'practice_phone' => $request->practice_phone,
                'practice_fax' => $request->practice_fax,
                'email' => $request->email,
                'business_hours' => $request->business_hours,
                'mailing_address' => $request->mailing_address,
                'service_address' => $commaSeparatedAddresses,
                'billing_mailing_address' => $request->billing_mailing_address,
                'specialty' => $request->specialty,
                'provider_name' => $request->provider_name,
                'provider_npi' => $request->provider_npi,
                'owner_dob' => $request->owner_dob!='null'? $request->owner_dob:null,
                'ssn_number' => $request->ssn_number,
                'license_number' => $request->license_number,
                'home_address' => $request->home_address,
            ]
        );
        if($request->login_id != null){
            Login::updateOrCreate(
                [
                    'id' => $request->login_id
                ],
                [
                    'credential_id' => $item->credential_id,
                    'user_id' => Auth::user()->user_id,
                    'availity_state' => $request->availity_state,
                    'availity_username' => $request->availity_username,
                    'availity_password' => $request->availity_password,
                    'caqh_username' => $request->caqh_username,
                    'caqh_password' => $request->caqh_password,
                    'nppes_username' => $request->nppes_username,
                    'nppes_password' => $request->nppes_password,
                    'provider_source_username' => $request->provider_source_username,
                    'provider_source_password' => $request->provider_source_password,
                    'uhc_username' => $request->uhc_username,
                    'uhc_password' => $request->uhc_password,
                ]
            );
        }
        $response['data'] = Credential::with('logins', 'credential_documents')->where('credential_id', $item->credential_id)->first();
        $response['user'] = Auth::user();
        $response['status'] = "Success";
        $response['address_data'] = $commaSeparatedAddresses;
        return response()->json($response);
    }
    public function updateLoginInfo(Request $request){
        Login::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'credential_id' => $request->credential_id,
                'user_id' => Auth::user()->user_id,
                'availity_state' => $request->availity_state,
                'availity_username' => $request->availity_username,
                'availity_password' => $request->availity_password,
                'caqh_username' => $request->caqh_username,
                'caqh_password' => $request->caqh_password,
                'nppes_username' => $request->nppes_username,
                'nppes_password' => $request->nppes_password,
                'provider_source_username' => $request->provider_source_username,
                'provider_source_password' => $request->provider_source_password,
            ]
        );
        $response['data'] = $request->all();
        $response['user'] = Auth::user();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function getAppList(){
        $response['app_list'] = UserApplication::with('insurance', 'credential', 'insurance_timeline')
            ->whereUserId(Auth::user()->user_id)
            ->orderBy('last_update_date', 'DESC')
            ->get();
        $response['user'] = Auth::user();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function getUserDashboardInfo(){
        $response['app_updates'] = UserApplication::with('insurance', 'credential', 'insurance_timeline')
            ->whereUserId(Auth::user()->user_id)
            ->orderBy('last_update_date', 'DESC')
            ->limit(10)
            ->get();
        $response['user'] = Auth::user();
        $response['providers'] = Credential::where('form_type', 'credentialing_individual_provider')->whereUserId(Auth::user()->user_id)->count();
        $response['practuces'] = Credential::where('form_type', 'credentialing_agencies')->whereUserId(Auth::user()->user_id)->count();
        $response['status'] = "Success";
        $total_insurances = UserInsurance::where('user_id', Auth::user()->user_id)->count();
        $total_app = UserApplication::where('user_id', Auth::user()->user_id)->count();
        $app_stats = DB::table('user_applications')
            ->select(DB::raw('user_id,insurance_status, COUNT(id) AS count'))
            ->where('user_id', Auth::user()->user_id)
            ->groupBy('user_id', 'insurance_status')->get();

        $query_invoice = Invoice::with(['user' => function ($query) {
            $query->where('user_id', '=', Auth::user()->user_id);
        }])->with('receipts')->whereUserId(Auth::user()->user_id);
        $response['invoices'] = $query_invoice->get();

        $response['paid_amount'] = Receipt::select(DB::raw('user_id, sum(total_amount) as paid_amount'))
            ->where('user_id', Auth::user()->user_id)
            ->groupBy('user_id')->first();
        $response['payable_amount'] = Invoice::select(DB::raw('user_id, sum(total_amount) as payable_amount'))
            ->where('user_id', Auth::user()->user_id)
            ->groupBy('user_id')->first();

        $response['total_insurances'] = $total_insurances;
        $response['app_stats'] = $app_stats;
        $response['total_app'] = $total_app;
        return response()->json($response);
    }
    public function getDocList(){
        $response['doc_list'] = UserDocument::whereUserId(Auth::user()->user_id)->get();
        $response['user'] = Auth::user();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function updateDocument(Request $request){
        try {
            if ($request->irs_letter_image) {
                $this->addCredentialDocuments($request,'irs_letter_image');
            }
            if($request->professional_liability_insurance_image){
                $this->addCredentialDocuments($request,'professional_liability_insurance_image');
            }
            if($request->bank_letter_image){
                $this->addCredentialDocuments($request,'bank_letter_image');
            }
            if($request->w9_form_image){
                $this->addCredentialDocuments($request,'w9_form_image');
            }
            if($request->state_license_image){
                $this->addCredentialDocuments($request,'state_license_image');
            }
            if($request->driver_license_image){
                $this->addCredentialDocuments($request,'driver_license_image');
            }
            if($request->resume_image){
                $this->addCredentialDocuments($request,'resume_image');
            }
            if($request->degree_image){
                $this->addCredentialDocuments($request,'degree_image');
            }
            if($request->board_certification_image){
                $this->addCredentialDocuments($request,'board_certification_image');
            }
            if($request->accreditation_image){
                $this->addCredentialDocuments($request,'accreditation_image');
            }
            if($request->additional_document_image){
                $this->addCredentialDocuments($request,'additional_document_image');
            }
            $response['data'] = CredentialingDocument::where('credential_id', $request->credential_id)->first();
            $response['status'] = "Success";
        } catch (\Exception $e) {
            $response['status'] = "Failure";
            $response['result'] = $e->getMessage();
        }
        return response()->json($response);
    }
    public function addProviderPractices(Request $request){
        foreach ( explode(",",$request->selected_options) as $selected_option){
            ProviderPractice::updateOrCreate(
                [
                    'provider_id' => $request->credential_id,
                    'practice_id' => $selected_option,

                ],
                [
                    'status' => 1
                ]
            );
        }
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function addUserInsurances(Request $request){
        foreach ( explode(",",$request->insurances) as $selected_option){
            UserInsurance::updateOrCreate(
                [
                    'user_id' => Auth::user()->user_id,
                    'insurance_id' => $selected_option,

                ],
                [
                    'status' => 1
                ]
            );
        }
        $response['data'] = $this->getUserInfo();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function getPractices($credential_id){
        $response['practices'] = ProviderPractice::with('practice')->where('provider_id', $credential_id)->get();
        $practice_ids = $response['practices']->pluck('practice_id')->toArray();
        $response['available_practices'] = Credential::whereUserId(Auth::user()->user_id)
            ->where('form_type', 'credentialing_agencies')
            ->whereNotIn('credential_id', $practice_ids)
            ->get();
        $response['status'] = "Success";
        return response()->json($response);
    }
    public function updateAppInfo(Request $request){
        Credential::updateOrCreate(
            [
                'credential_id' => $request->credential_id
            ],
            [
                'group_name' => $request->group_name,
                'group_npi' => $request->group_npi,
                'group_tax_id' => $request->group_tax_id,
                'practice_phone' => $request->practice_phone,
                'practice_fax' => $request->practice_fax,
                'email' => $request->email,
                'business_hours' => $request->business_hours,
                'mailing_address' => $request->mailing_address,
                'service_address' => $request->service_address,
                'billing_mailing_address' => $request->billing_mailing_address,
                'specialty' => $request->specialty,
                'provider_name' => $request->provider_name,
                'provider_npi' => $request->provider_npi,
                'owner_dob' => $request->owner_dob!='null'? $request->owner_dob:null,
                'ssn_number' => $request->ssn_number,
                'license_number' => $request->license_number,
                'home_address' => $request->home_address,
            ]
        );
        $response['item'] = UserApplication::with('insurance', 'credential', 'insurance_timeline')
            ->whereId($request->app_id)
            ->first();
        $response['user'] = Auth::user();
        $response['status'] = "Success";
        return response()->json($response);
    }

    function addCredentialDocuments(Request $request, $doc_name){
        $docs_upload_files = [];
        foreach ($request->{$doc_name} as $file_image){
            $name = time() . rand(1, 100) . '.' . $file_image->extension();
            $file_image->move(public_path('credential_images'), $name);
            $docs_upload_files[] = $name;
        }
        $new_docs_upload_files = implode(',', $docs_upload_files);
        $existingDocument = CredentialingDocument::where('credential_id' , $request->credential_id)->first();

        if ($existingDocument != null) {
            $currentValue = $existingDocument->{$doc_name};
            if ($currentValue !== null && $currentValue !== '') {
                $existingDocument->{$doc_name} .= ',' . $new_docs_upload_files;
            } else {
                $existingDocument->{$doc_name} = $new_docs_upload_files;
            }
            $existingDocument->user_id = Auth::user()->user_id;
            $existingDocument->save();
        } else {
            CredentialingDocument::create(
                [
                    'credential_id' => $request->credential_id,
                    'user_id' => Auth::user()->user_id,
                    $doc_name => $new_docs_upload_files
                ]);
        }
    }
    //Invoice data
    public function userFinanceDetails()
    {
        $user_id = Auth::user()->user_id;
        if ( $user_id) {
            //$response['invoices'] = Invoice::with('user','receipts')->whereUserId($request->customer_id)->get();

            $query_invoice = Invoice::with(['user' => function ($query) use ($user_id) {
                $query->where('user_id', '=', $user_id);
            }])->with('receipts')->whereUserId($user_id);
            $response['invoices'] = $query_invoice->get();

            $response['receipts'] = Receipt::with('receipt_added_by','receipt_invoice_details.invoice')->whereUserId($user_id)->get();
            $response['unpaid_invoices'] = Invoice::doesntHave('invoice_receipt')->whereUserId($user_id)->get();

            $query=AccountStatement::whereUserId($user_id);
            $response['account_statements'] = $query->orderBy('added_on','desc')->get();

            $response['total_receipt'] = $query->whereType('Receipt')->get();
            $response['total_invoice'] = AccountStatement::whereUserId($user_id)->whereType('Invoice')->get();

            $response['status'] = 'success';
        }else{
            $response['status']='Failure2';
            $response['result']= 'Requested Field are required';
        }
        return response()->json($response);

    }

    public function userFinanceDetailsNew()
    {
        $user_id = Auth::user()->user_id;
        if ( $user_id) {
            //$response['invoices'] = Invoice::with('user','receipts')->whereUserId($request->customer_id)->get();

            $query_invoice = Invoice::with(['user' => function ($query) use ($user_id) {
                $query->where('user_id', '=', $user_id);
            }])->with('receipts','user.user_card', 'receipt_amount', 'applications')->whereUserId($user_id);
            $response['invoices'] = $query_invoice->get();

            $response['receipts'] = Receipt::with('receipt_added_by','receipt_invoice_details.invoice')->whereUserId($user_id)->get();
            $response['unpaid_invoices'] = Invoice::doesntHave('invoice_receipt')->whereUserId($user_id)->get();

            $query=InvoiceStatementCustomer::whereUserId($user_id);
            $response['account_statements'] = $query->orderBy('added_on','desc')->get();

            $response['total_receipt'] = $query->whereType('Receipt')->get();
            $response['total_invoice'] = InvoiceStatementCustomer::whereUserId($user_id)->whereType('Invoice')->get();

            $response['user'] = User::with('user_card')->where('user_id', Auth::user()->user_id)->first();
            $response['status'] = 'success';
        }else{
            $response['status']='Failure2';
            $response['result']= 'Requested Field are required';
        }
        return response()->json($response);

    }
    public function addCardDetail(Request $request){
        $response['addCardDetail'] = $request->all();
        $response['status'] = "Success";
        $response['user'] = Auth::user();
        return response()->json($response);
    }
    public function cardPayNow(Request $request){
        $response['addCardDetail'] = $request->all();
        $response['status'] = "Success";
        $response['user'] = Auth::user();
        return response()->json($response);
    }
    public function updateInvoice(Request $request){
        $receipt = Receipt::create([
            'title' => Auth::user()->full_name,
            'user_id' => Auth::user()->user_id,
            'transaction_id' => $request->transaction_id,
            'invoice_id' => $request->invoice_id,
            'customer_id' => Auth::user()->customer_id,
            'total_amount' => $request->payable,
            'receipt_date' => get_date_time(),
            'added_by' =>  Auth::user()->user_id,
            'added_by_name' =>  Auth::user()->full_name,
            'added_on' => get_date_time(),
            'payment_status' =>  $request->remaining_due > 0 ? 'partial' : 'paid',
        ]);
        if($request->save_card === 'true'){
            $response['save_card'] =  $request->save_card;
            UserCard::updateOrCreate(
                [
                    'card_number' => $request->card_number,
                ],
                [
                'user_id' => Auth::user()->user_id,
                'full_name' => $request->full_name,
                'card_number' => $request->card_number,
                'exp_date' => $request->exp_date,
                'cvv' => $request->cvv,
                'added_on' => get_date_time(),
            ]);
        }
//        if ($request->remaining_due == 0) {
            Invoice::where('invoice_id', $request->invoice_id)
                ->where('user_id', Auth::user()->user_id)
                ->update([
                    'is_paid' => 1,
                    'modified_on' => get_date_time(),
                ]);
//        }
        $response['transaction_id'] =  $request->save_card;
//        $response['$receipt'] = $receipt;
        $response['updateInvoice'] = $request->all();
        $response['status'] = "Success";
        $response['user'] = Auth::user();
        return response()->json($response);
    }
}
