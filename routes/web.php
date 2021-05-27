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

Route::get('/', function () {
    return view('backends.pages.main');
});

Route::get('/test', function () {
    return view('backends.pages.user.index_test');
});

Route::get('/login', function () {
    return view('backends.pages.user.login');
});

Route::get('user/data', 'backends\user\UserController@data')->name('user.data');
Route::resource('user', 'backends\user\UserController');

