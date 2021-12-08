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


Route::namespace('backends\user')->group(function () {
    Route::get('/','AuthController@showLoginForm');
    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login','AuthController@authenticate')->name('login');
    Route::get('/register','AuthController@show_signup_form')->name('register');
    Route::post('/register','AuthController@process_signup');
    Route::post('/logout','AuthController@logout')->name('logout');
});






Route::group(['middleware'=>'auth'],function () {


    Route::get('user/data', 'backends\user\UserController@data')->name('user.data');
    Route::resource('user', 'backends\user\UserController');

    Route::get('customer/data', 'backends\person\CustomerController@data')->name('customer.data');
    Route::resource('customer', 'backends\person\CustomerController');

    Route::patch('lookup_detail/{lookup_detail}','backends\setups\LookupDetailController@update')->name('lookup_detail.update');;
    Route::resource('lookup.lookup_detail' , 'backends\setups\LookupDetailController')->shallow();
    Route::resource('lookup', 'backends\setups\LookupController');

    Route::get('savings/scheme/data', 'backends\savings\SavingsSchemeController@data')->name('scheme.data');
    Route::resource('savings/scheme', 'backends\savings\SavingsSchemeController');

    Route::get('savings/account/data', 'backends\savings\SavingsAccountController@data')->name('account.data');
    Route::resource('savings/account', 'backends\savings\SavingsAccountController');

    Route::get('savings/deposit/create/{savings_accounts_id}/{date}', 'backends\savings\SavingsDepositController@create')->name('deposit.create');
    Route::post('savings/deposit/store/{savings_accounts_id}', 'backends\savings\SavingsDepositController@store')->name('deposit.store');
    Route::get('savings/deposit/data/{date?}', 'backends\savings\SavingsDepositController@data')->name('deposit.data');
    Route::post('savings/deposit', 'backends\savings\SavingsDepositController@index')->name('deposit.index');
    Route::resource('savings/deposit', 'backends\savings\SavingsDepositController')->except([
        'create', 'store'
    ]);
    Route::get('savings/deposit/report/month-wise', 'backends\savings\SavingsDepositController@monthWiseDepositReport')->name('deposit.report.month-wise');
    Route::match(['get', 'post'], 'savings/deposit/report/month-wise', 'backends\savings\SavingsDepositController@monthWiseDepositReport')->name('deposit.report.month-wise');



    Route::get('loan/scheme/data', 'backends\loan\LoanSchemeController@data')->name('loan_scheme.data');
    Route::resource('loan/scheme', 'backends\loan\LoanSchemeController', ['names' => 'loan_scheme']);

    Route::get('loan/account/data', 'backends\loan\LoanAccountController@data')->name('loan_account.data');
    Route::resource('loan/account', 'backends\loan\LoanAccountController', ['names' => 'loan_account']);

    Route::resource('/home', 'backends\user\UserController');

});

