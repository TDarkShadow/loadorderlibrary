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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/loadorders/{slug}', 'LoadOrderController@show');

Route::prefix('guest')->group(function () {
	Route::get('upload', 'UploadController@index')->name('guest-upload');
	Route::post('upload', 'UploadController@store')->name('guest-upload-store');
});

Route::Auth();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/upload', 'UploadController@index')->name('user-upload');
Route::post('/upload', 'UploadController@store')->name('user-upload-store');