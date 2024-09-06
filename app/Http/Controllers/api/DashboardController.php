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
use App\Models\Login;
use App\Models\LoginStatus;
use App\Models\ApplicationComment;
use App\Models\Receipt;
use App\Models\User;
use App\Models\UserApplication;
use App\Models\UserInsurance;
use App\Models\UserInsuranceApplicationView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function customer_dashboard_stats(Request $request)
    {
        //logined auth user =  $request->input('data.user_id')
        $public_user_ids = User::where('status', 1)->get()->pluck('user_id')->toArray();
        $total_insurances = UserInsurance::where('status', 1)->count();

        $response['current_user_today_income'] = Receipt::selectRaw('DATE(receipts.added_on) as date, SUM(receipts.total_amount) as amount, 
             users.credential_assign as credential_assign')
            ->join('users', 'receipts.user_id', '=', 'users.user_id')
            ->with(['user' => function ($query) {
                $query->whereNotNull('users.credential_assign');
            }])
            ->whereNotNull('receipts.user_id')
            ->groupBy('date', 'users.credential_assign')
            ->orderBy('date', 'desc')
            ->get();


        //daily_income last six months
        $response['daily_income'] = Receipt::selectRaw('date(added_on) date, sum(total_amount) amount')
            ->where('added_on', '>=', now()->subMonths(6))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        //logic for get users against customer id
        // Application status credential agent = 3

        $app_stats= [];
        $total_app = [];
        $update_over_due = [];

        if($request->input('data.role_id') == 3){
            $userIds = User::where('credential_assign', $request->input('data.user_id'))->pluck('user_id')->toArray();

            $app_stats = DB::table('user_applications')->select(DB::raw('insurance_status, COUNT(id) AS count'))->whereIn('user_id', $userIds)
                ->where('is_paid', 1)->groupBy('insurance_status')->get();
            $application_ids = UserApplication::whereIn('user_id', $userIds)->pluck('id')->toArray();
            $response['timeline_logs'] = InsuranceTimeline::with('user_application.insurance','user_application.credential')->whereIn('user_application_id', $application_ids)->orderBy('created_at', 'DESC')->limit(20)->get();

            $total_app = UserApplication::whereIn('user_id', $userIds)->where('is_paid', 1)->count();
            $update_over_due = UserApplication::whereIn('user_id', $userIds)->where('up_coming_date', '!=', null)->whereDate('up_coming_date', '<=', eastern_date_time())->count();

            $response['practices'] = Credential::whereIn('user_id', $userIds)->count();
            $response['customer_group'] = Credential::whereIn('user_id', $userIds)->where('form_type', 'credentialing_agencies')->count();
            $response['individuals'] = Credential::whereIn('user_id', $userIds)->where('form_type', 'credentialing_individual_provider')->count();
        }else{
            $total_app = UserApplication::where('is_paid', 1)->count();
            $update_over_due = UserApplication::where('up_coming_date', '!=', null)->whereDate('up_coming_date', '<=', eastern_date_time())->count();
            $app_stats = DB::table('user_applications')->select(DB::raw('insurance_status, COUNT(id) AS count'))->where('is_paid', 1)->groupBy('insurance_status')->get();

            $response['timeline_logs'] = InsuranceTimeline::with(['user_application', 'user_application.insurance','user_application.credential'])->orderBy('id', 'DESC')->limit(20)->get();
            $response['practices'] = Credential::count();
            $response['customer_group'] = Credential::where('form_type', 'credentialing_agencies')->count();
            $response['individuals'] = Credential::where('form_type', 'credentialing_individual_provider')->count();
        }

        // monthly_income last six months, sales agent = 4, credential agent = 3, sale manager = 2, admin =1 credential manager = 5, (lead =6 not sure)
        if ($request->input('data.role_id') == 4) {
            $userIds = User::whereIn('customer_id', $request->customer_ids)->pluck('user_id')->toArray();
            $response['last_six_monthly_sales'] = Receipt::selectRaw('year(added_on) as year, monthname(added_on) as month, sum(total_amount) as amount')
                ->whereIn('user_id', $userIds)
                ->where('added_on', '>=', now()->subMonths(5))
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'desc')
                ->get();

//            $response['current_month_income1'] = Receipt::selectRaw('year(added_on) as year, monthname(added_on) as month, sum(total_amount) as amount')
//                ->whereIn('user_id', $userIds)->whereYear('added_on', now()->year)->whereMonth('added_on', now()->month)->groupBy('year', 'month')
//                ->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

            $response['current_month_income'] = Receipt::selectRaw('year(added_on) as year, monthname(added_on) as month, sum(total_amount) as amount')
                ->whereIn('user_id', $userIds)
                ->whereBetween('added_on', [now()->startOfMonth(), now()->endOfMonth()])
                ->groupBy('year', 'month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();


            $response['today_income'] = Receipt::selectRaw('date(added_on) date, sum(total_amount) amount')
                ->whereIn('user_id', $userIds)->whereDate('added_on', now()->toDateString())
                ->groupBy('date')->orderBy('date', 'desc')->get();
            $response['totalReceipt'] = AccountStatement::whereType('Receipt')->where('added_by', $request->input('data.user_id'))->count();
            $response['totalInvoice'] = AccountStatement::whereType('Invoice')->where('added_by', $request->input('data.user_id'))->count();
        }else{
            $response['last_six_monthly_sales'] = Receipt::selectRaw('year(added_on) as year, monthname(added_on) as month, sum(total_amount) as amount')
                ->where('added_on', '>=', now()->subMonths(5))
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'desc')
                ->get();
            $response['current_month_income'] = Receipt::selectRaw('year(added_on) as year, monthname(added_on) as month, sum(total_amount) as amount')
                ->whereYear('added_on', now()->year)->whereMonth('added_on', now()->month)->groupBy('year', 'month')
                ->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

            $response['today_income'] = Receipt::selectRaw('date(added_on) date, sum(total_amount) amount')
                ->whereDate('added_on', now()->toDateString())
                ->groupBy('date')->orderBy('date', 'desc')->get();
            $response['totalReceipt'] = AccountStatement::whereType('Receipt')->count();
            $response['totalInvoice'] = AccountStatement::whereType('Invoice')->count();
        }


        $response['status'] = 'Success';
        $response['total_insurances'] = $total_insurances;
        $response['update_over_due'] = $update_over_due;
        $response['app_stats'] = $app_stats;
        $response['total_app'] = $total_app;
        $response['request'] = json_encode($request->all()) . ' data id ' . $request->input('data.role_id');
        return response()->json($response);
    }
}
