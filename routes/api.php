<?php
use App\Http\Middleware\AuthApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [App\Http\Controllers\api\UserController::class, 'getUser']);
    Route::get('/get_user_info', [App\Http\Controllers\api\UserController::class, 'getUserInfo']);
    Route::post('/update_personal_info', [App\Http\Controllers\api\UserController::class, 'updatePersonalInfo']);
    Route::post('/update_login_info', [App\Http\Controllers\api\UserController::class, 'updateLoginInfo']);
    Route::get('/get_app_list', [App\Http\Controllers\api\UserController::class, 'getAppList']);
    Route::get('/get_user_dashboard_info', [App\Http\Controllers\api\UserController::class, 'getUserDashboardInfo']);
    Route::get('/get_doc_list', [App\Http\Controllers\api\UserController::class, 'getDocList']);
    Route::post('/update_document', [App\Http\Controllers\api\UserController::class, 'updateDocument']);
    Route::post('/add_provider_practices', [App\Http\Controllers\api\UserController::class, 'addProviderPractices']);
    Route::post('/add_user_insurances', [App\Http\Controllers\api\UserController::class, 'addUserInsurances']);
    Route::get('/get_practices/{credential_id}', [App\Http\Controllers\api\UserController::class, 'getPractices']);
    Route::post('/update_app_info', [App\Http\Controllers\api\UserController::class, 'updateAppInfo']);
    Route::post('/reset_password', [App\Http\Controllers\api\AuthController::class, 'resetPassword']);
    Route::post('/logout', [App\Http\Controllers\api\AuthController::class, 'logout']);
    Route::get('/user_finance_details', [App\Http\Controllers\api\UserController::class, 'userFinanceDetails']);
    Route::get('/user_finance_details_new', [App\Http\Controllers\api\UserController::class, 'userFinanceDetailsNew']);
    Route::post('/add_card_detail', [App\Http\Controllers\api\UserController::class, 'addCardDetail']);
    Route::post('/update_invoice_data', [App\Http\Controllers\api\UserController::class, 'updateInvoice']);
    Route::post('/card_pay_now', [App\Http\Controllers\api\UserController::class, 'cardPayNow']);
});

Route::middleware(AuthApi::class)->group(function () {
    Route::post('/contact_us_form_data', 'App\Http\Controllers\FrontEndController@contact_us_form_data')->name('contact_us_form_data');
    Route::post('/create_new_api_user', 'App\Http\Controllers\LoginController@create_new_api_user')->name('create_new_api_user');
    Route::get('/get_billing_and_credentialing_detial/{user_name}', 'App\Http\Controllers\UserController@get_billing_and_credentialing_detial')->name('get_billing_and_credentialing_detial');
    Route::get('/get_billing_and_credentialing', 'App\Http\Controllers\UserController@get_billing_and_credentialing')->name('get_billing_and_credentialing');
    Route::post('/verify_user_email', 'App\Http\Controllers\UserController@verify_user_email')->name('verify_user_email');
    Route::post('/form_document_status', 'App\Http\Controllers\UserController@form_document_status')->name('form_document_status');
    Route::post('/add_insurance_timeline', 'App\Http\Controllers\UserController@add_insurance_timeline')->name('add_insurance_timeline');
    Route::get('/view_insurance_timeline/{user_insurance_id}', 'App\Http\Controllers\UserController@view_insurance_timeline')->name('view_insurance_timeline');
    Route::get('/view_credential_individual/{credential_id}', 'App\Http\Controllers\UserController@view_credential_individual')->name('view_credential_individual');
    Route::get('/view_credential_group/{credential_id}', 'App\Http\Controllers\UserController@view_credential_group')->name('view_credential_group');
    Route::post('/personal_form_update', 'App\Http\Controllers\UserController@personal_form_update')->name('personal_form_update');
    Route::post('/login_form_update', 'App\Http\Controllers\UserController@login_form_update')->name('login_form_update');
    Route::get('/get_billing_and_credentialing_detial_byid/{credential_id}', 'App\Http\Controllers\UserController@get_billing_and_credentialing_detial_byid')->name('get_billing_and_credentialing_detial_byid');
    Route::post('/form_status', 'App\Http\Controllers\UserController@form_status')->name('form_status');
    Route::post('/save_insurances', 'App\Http\Controllers\UserController@save_insurances')->name('save_insurances');
    Route::get('/get_user_insurances/{credential_id}', 'App\Http\Controllers\UserController@get_user_insurances')->name('get_user_insurances');
    Route::post('/save_user_insurances', 'App\Http\Controllers\UserController@save_user_insurances')->name('save_user_insurances');
    Route::get('/get_billing_documents/{email}', 'App\Http\Controllers\UserController@get_billing_documents')->name('get_billing_documents');
    Route::post('/add_billing_user', 'App\Http\Controllers\LoginController@add_billing_user')->name('add_billing_user');
    Route::post('/remove_insurance', 'App\Http\Controllers\UserController@remove_insurance')->name('remove_insurance');
    Route::get('/get_public_data', 'App\Http\Controllers\UserController@get_public_data')->name('get_public_data');
    Route::get('/get_credentialing_insurances_detial/{user_name}', 'App\Http\Controllers\UserController@get_credentialing_insurances_detial')->name('get_credentialing_insurances_detial');
});
Route::get('/get_credential_group_insurances/{credential_id}', 'App\Http\Controllers\UserController@get_credential_group_insurances')->name('get_credential_group_insurances');

// ========== New API Routes ================= //
Route::middleware(AuthApi::class)->group(function () {
    Route::get('/get_customer_details/{email}', 'App\Http\Controllers\api\Customer@get_customer_details');
    Route::get('/get_new_insurances_application/{role}/{userid}', 'App\Http\Controllers\api\Customer@get_new_insurances_application')->name('get_new_insurances_application');
    Route::get('/get_insurances_app_scroll/{page}', 'App\Http\Controllers\api\Customer@get_insurances_app_scroll')->name('get_insurances_app_scroll');
    Route::post('/app_search_query_by_title', 'App\Http\Controllers\api\Customer@app_search_query_by_title')->name('app_search_query_by_title');
    Route::post('/app_search_new_and_assign_list', 'App\Http\Controllers\api\Customer@app_search_new_and_assign_list')->name('app_search_new_and_assign_list');
    Route::get('/get_insurances_application_timeline_detail/{user_insurance_id}', 'App\Http\Controllers\api\Customer@get_insurances_application_timeline_detail')->name('get_insurances_application_timeline_detail');
    Route::post('/get_app_assigned_insurances', 'App\Http\Controllers\api\Customer@get_app_assigned_insurances')->name('get_app_assigned_insurances');
    Route::post('/credential_assign_to', 'App\Http\Controllers\api\Customer@credential_assign_to')->name('credential_assign_to');
    Route::post('/update_partial_customer_info_lead', 'App\Http\Controllers\api\Customer@update_partial_customer_info_lead')->name('update_partial_customer_info_lead');
    Route::get('/get_agent_assigned_insurances/{agent_id}', 'App\Http\Controllers\api\Customer@get_agent_assigned_insurances')->name('get_agent_assigned_insurances');
    Route::get('/user_app_list/{email}', 'App\Http\Controllers\api\Customer@user_app_list');
    Route::post('/add_new_group_info', 'App\Http\Controllers\api\Customer@add_new_group_info');
    Route::post('/add_new_group_individual_info', 'App\Http\Controllers\api\Customer@add_new_group_individual_info');
    Route::get('/get_customer_insurances/{public_user_id}/{email}', 'App\Http\Controllers\api\Customer@get_customer_insurances');
    Route::post('/add_customer_insurances', 'App\Http\Controllers\api\Customer@add_customer_insurances');
    Route::get('/get_customer_provider/{user_id}/{email}/{insurance_id}', 'App\Http\Controllers\api\Customer@get_customer_provider');
    Route::post('/add_customer_insurance_application', 'App\Http\Controllers\api\Customer@add_customer_insurance_application');
    Route::post('/remove_provider_from_application', 'App\Http\Controllers\api\Customer@remove_provider_from_application');
    Route::get('/get_customer_stats/{public_user_id}/{email}', 'App\Http\Controllers\api\Customer@get_customer_stats');
    Route::get('/get_payment_stats/{user_id}', 'App\Http\Controllers\api\Customer@get_payment_stats');
    Route::post('/add_assigned_credentials', 'App\Http\Controllers\api\Customer@add_assigned_credentials');
    Route::post('/add_comment', 'App\Http\Controllers\api\Customer@add_comment');
    Route::get('/get_comments/{application_id}', 'App\Http\Controllers\api\Customer@get_comments');
    Route::get('/get_comments/{application_id}', 'App\Http\Controllers\api\Customer@get_comments');
    Route::post('/remove_customer_insurances', 'App\Http\Controllers\api\Customer@remove_customer_insurances');
    Route::get('/get_unpaid_invoice_for_receipt/{user_id}', 'App\Http\Controllers\api\Customer@get_unpaid_invoice_for_receipt');
    Route::post('/add_customer_invoice', 'App\Http\Controllers\api\Customer@add_customer_invoice');
    Route::post('/add_customer_receipt', 'App\Http\Controllers\api\Customer@add_customer_receipt');
    Route::post('/customer_finance_details', 'App\Http\Controllers\api\Customer@customer_finance_details');
    Route::post('/delete_customer_invoice', 'App\Http\Controllers\api\Customer@delete_customer_invoice');
    Route::post('/delete_customer_receipt', 'App\Http\Controllers\api\Customer@delete_customer_receipt');
    Route::post('/customer_assigned_to_credential', 'App\Http\Controllers\api\Customer@customer_assigned_to_credential');
    Route::post('/view_account_statement_detail', 'App\Http\Controllers\api\Customer@view_account_statement_detail');
    Route::post('/customer_docs_upload', 'App\Http\Controllers\api\Customer@customer_docs_upload');
    Route::post('/remove_customer_docs', 'App\Http\Controllers\api\Customer@remove_customer_docs');
    Route::post('/add_any_documents', 'App\Http\Controllers\api\Customer@add_any_documents');
    Route::get('/get_any_customer_docs/{user_id}', 'App\Http\Controllers\api\Customer@get_any_customer_docs');
    Route::post('/customer_account_statement_detail', 'App\Http\Controllers\api\Customer@customer_account_statement_detail');
    Route::post('/login_form_update_react', 'App\Http\Controllers\api\Customer@login_form_update_react');
    Route::post('/add_insurance_timeline_react', 'App\Http\Controllers\api\Customer@add_insurance_timeline_react');
    Route::post('/personal_form_update_react', 'App\Http\Controllers\api\Customer@personal_form_update_react');
    Route::post('/form_status_react', 'App\Http\Controllers\api\Customer@form_status_react');
    Route::post('/create_new_user_rcm_api', 'App\Http\Controllers\api\Customer@create_new_user_rcm_api');


    Route::post('/customer_dashboard_stats', 'App\Http\Controllers\api\DashboardController@customer_dashboard_stats');

    Route::get('/add_old_app_user_insurances', 'App\Http\Controllers\api\Customer@add_old_app_user_insurances');
});