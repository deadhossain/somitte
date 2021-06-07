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

Route::get('/', function () {
    return view('backends.pages.main');
});

// Route::get('/login', function () {
//     return view('backends.pages.user.login');
// });

Route::get('user/data', 'backends\user\UserController@data')->name('user.data');
Route::resource('user', 'backends\user\UserController');

Route::namespace('backends\user')->group(function () {
    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login','AuthController@authenticate')->name('login');
    Route::get('/register','AuthController@show_signup_form')->name('register');
    Route::post('/register','AuthController@process_signup');
    Route::post('/logout','AuthController@logout')->name('logout');
});
