<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('verified')->prefix('dashboard')->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    Route::resource('user', 'UserController');

    Route::resource('role', 'RoleController');

    Route::resource('permission', 'PermissionController');

    Route::resource('permanent_placement', 'PermanentPlacementController');

    Route::resource('contract_billing', 'ContractBillingController');
    Route::patch('contract_billing/{contract_billing}/approve', 'ContractBillingController@approve')->name('contract_billing.approve');
    Route::patch('contract_billing/{contract_billing}/unapprove', 'ContractBillingController@unapprove')->name('contract_billing.unapprove');

    Route::resource('distribution_email', 'DistributionEmailController');

    Route::resource('distribution_list', 'DistributionListController');

    Route::resource('email_setting', 'EmailSettingController');

    Route::get('mailable/contract_billing/{contract_billing}', 'MailableController@billing')->name('mailable.contract_billing');

    Route::get('mailable/permanent_placement/{permanent_placement}', 'MailableController@placement')->name('mailable.permanent_placement');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
