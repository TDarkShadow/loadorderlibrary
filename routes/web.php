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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// List View/Upload Routes.
Route::get('/lists', 'LoadOrderController@index')->name('lists');
Route::get('/upload', 'LoadOrderController@create')->name('upload');
Route::post('/upload', 'LoadOrderController@store')->name('upload.store');
Route::get('/lists/{load_order:slug}', 'LoadOrderController@show');
Route::delete('/lists/{load_order:slug}', 'LoadOrderController@destroy');

// Comparison Routes.
Route::get('/compare', 'ComparisonController@index')->name('compare');
Route::post('/compare', 'ComparisonController@post')->name('compare-post');
Route::get('/compare/{load_order}/{load_order2}', 'ComparisonController@results')->name('compare-results');

// Account Management Routes.
Route::get('/account/change-password', 'ChangePasswordController@index')->name('change-password');
Route::post('/account/change-password', 'ChangePasswordController@store')->name('change-password-post');
Route::get('/account/delete', 'DeleteAccountController@index')->name('delete-account');
// TODO: deleted/edit. 

// Intentional error routes for testing purposes.
Route::get('/errors/500', 'IntentionalErrorsController@http500')->name('500-error');



