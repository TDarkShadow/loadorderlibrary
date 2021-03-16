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
Route::get('/lists/{load_order:slug}/edit', 'LoadOrderController@edit')->name('lists.edit');
Route::put('/lists/{load_order:slug}', 'LoadOrderController@update')->name('lists.update');
Route::get('/lists/{load_order:slug}', 'LoadOrderController@show');
Route::get('/lists/{load_order:slug}/download/{file}', 'DownloadController@index');
Route::delete('/lists/{load_order:slug}', 'LoadOrderController@destroy');

// List View By Game/Author Routes.
Route::get('/game/{game:name}', 'LoadOrderController@showByGame')->name('lists.show-by-game');
Route::get('/author/{user:name}', 'LoadOrderController@showByAuthor')->name('lists.show-by-author');

// Comparison Routes.
Route::get('/compare', 'ComparisonController@index')->name('compare');
Route::post('/compare', 'ComparisonController@post')->name('compare-post');
Route::get('/compare/{load_order}/{load_order2}', 'ComparisonController@results')->name('compare-results');

// Account Management Routes.
Route::get('/account/change-password', 'ChangePasswordController@index')->name('change-password');
Route::post('/account/change-password', 'ChangePasswordController@store')->name('change-password-post');
Route::get('/account/delete', 'DeleteAccountController@index')->name('delete-account');
Route::post('/account/delete', 'DeleteAccountController@destroy')->name('delete-account-post');

// Admin routes
Route::get('admin/stats', 'AdminController@stats')->name('admin-stats');

// Intentional error routes for testing purposes.
Route::get('/errors/500', 'IntentionalErrorsController@http500')->name('500-error');



