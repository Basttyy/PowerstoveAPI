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

Route::get('/{any}', function () {
    return view('spapp');
})->where('any', '^(?!api).*$');
//where('any', '^(?!api)(?!email).*$');

Route::post('/#auth/password/reset', 'Auth\Api\ResetPasswordController@sendResetLink')->name('password.reset');
//Route::get('auth/email/verify/{id}', 'Auth\Api\VerificationApiController@verify')->name('verificationapi.verify');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
