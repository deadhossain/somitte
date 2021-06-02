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

// Route::get('/', 'backends\user\AuthController@showLoginForm');

Route::get('/test', function () {
    return view('backends.pages.user.index_test');
});

Route::get('/login', function () {
    return view('backends.pages.user.login');
});

Route::get('user/data', 'backends\user\UserController@data')->name('user.data');
Route::resource('user', 'backends\user\UserController');

Route::namespace('App\Http\Controllers\backends\user')->group(function () {
    Route::get('/login','AuthController@show_login_form')->name('login');
    Route::post('/login','backends\user\AuthController@authenticate')->name('login');
    Route::get('/register','LoginController@show_signup_form')->name('register');
    Route::post('/register','LoginController@process_signup');
    Route::post('/logout','LoginController@logout')->name('logout');
});
