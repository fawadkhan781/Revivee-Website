<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/{div?}/{scroll?}', function ($div, $scroll) {
//dd($div, $scroll);
//    return view('front_end.index');
//});
//Route::get('/', 'App\Http\Controllers\FrontEndController@index')->name('/');
Route::get('/', 'App\Http\Controllers\LoginController@index')->name('/');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/do_login', 'App\Http\Controllers\LoginController@login')->name('do_login');
Route::middleware(\App\Http\Middleware\EnsureLogin::class)->group(function () {
    Route::get('/user_dashboard/{id?}', 'App\Http\Controllers\UserController@user_dashboard')->name('user_dashboard');
    Route::get('/user_timeline/{credential_id}/{insurance_id}', 'App\Http\Controllers\UserController@user_timeline')->name('user_timeline');
    Route::get('/view_individual_credential/{id}/{step?}', 'App\Http\Controllers\UserController@view_individual_credential')->name('view_individual_credential');
    Route::get('/user_form', 'App\Http\Controllers\UserController@user_form')->name('user_form');
    Route::get('/user_form_account', 'App\Http\Controllers\UserController@user_form_account')->name('user_form_account');
    Route::get('/test_user_form', 'App\Http\Controllers\UserController@test_user_form')->name('test_user_form');
    Route::post('/credentialing_form_save', 'App\Http\Controllers\UserController@credentialing_form_save')->name('credentialing_form_save');
    Route::post('/billing_data_save', 'App\Http\Controllers\UserController@billing_data_save')->name('billing_data_save');
    Route::post('/document_single_file_delete', 'App\Http\Controllers\UserController@document_single_file_delete')->name('document_single_file_delete');
    Route::post('/checking_password', 'App\Http\Controllers\UserController@checking_password')->name('checking_password');
    Route::post('/update_user_profile', 'App\Http\Controllers\UserController@update_user_profile')->name('update_user_profile');

    Route::post('/step_1_form_submit',[App\Http\Controllers\UserController::class,'step_1_form_submit'])->name('step_1_form_submit');
    Route::post('/step_2_form_submit',[App\Http\Controllers\UserController::class,'step_2_form_submit'])->name('step_2_form_submit');
    Route::post('/step_3_form_submit',[App\Http\Controllers\UserController::class,'step_3_form_submit'])->name('step_3_form_submit');
    Route::post('/step_4_form_submit',[App\Http\Controllers\UserController::class,'step_4_form_submit'])->name('step_4_form_submit');
    Route::post('/step_5_form_submit',[App\Http\Controllers\UserController::class,'step_5_form_submit'])->name('step_5_form_submit');
    Route::post('/individual_form_modal',[App\Http\Controllers\UserController::class,'individual_form_modal'])->name('individual_form_modal');
    Route::post('/delete_credential',[App\Http\Controllers\UserController::class,'delete_credential'])->name('delete_credential');
    Route::post('/add_file',[App\Http\Controllers\UserController::class,'add_file'])->name('add_file');
    Route::get('group_dashboard',[App\Http\Controllers\UserController::class,'group_dashboard'])->name('group_dashboard');
    Route::get('view_form/{id?}',[App\Http\Controllers\UserController::class,'view_form'])->name('view_form');
    Route::post('add_previous_provider',[App\Http\Controllers\UserController::class,'add_previous_provider'])->name('add_previous_provider');
    Route::post('provider_list',[App\Http\Controllers\UserController::class,'provider_list'])->name('provider_list');

    Route::get('/billing_user_dashboard', 'App\Http\Controllers\BillingController@billing_user_dashboard')->name('billing_user_dashboard');
    Route::post('/billing_folders', 'App\Http\Controllers\BillingController@billing_folders')->name('billing_folders');
    Route::post('/create_billing_folders', 'App\Http\Controllers\BillingController@create_billing_folders')->name('create_billing_folders');
    Route::post('/billing_documents', 'App\Http\Controllers\BillingController@billing_documents')->name('billing_documents');
    Route::post('/create_billing_documents', 'App\Http\Controllers\BillingController@create_billing_documents')->name('create_billing_documents');
    Route::post('/delete_document', 'App\Http\Controllers\BillingController@delete_document')->name('delete_document');

});
Route::post('/contact_us_form_save', 'App\Http\Controllers\FrontEndController@contact_us_form_save')->name('contact_us_form_save');

Route::get('/route-cache', function() {
    Cache::flush();
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Route::clearResolvedInstances();
    return 'Routes cache cleared';
});

