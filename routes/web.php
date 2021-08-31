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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/support-me', function () {
	return view('support-me');
});

// List View/Upload Routes.
Route::get('/lists', 'LoadOrderController@index')->name('lists');
Route::get('/upload', 'LoadOrderController@create')->name('upload');
Route::post('/upload', 'LoadOrderController@store')->name('upload.store');
Route::get('/lists/{load_order:slug}/edit', 'LoadOrderController@edit')->name('lists.edit');
Route::put('/lists/{load_order:slug}', 'LoadOrderController@update')->name('lists.update');
Route::get('/lists/{load_order:slug}', 'LoadOrderController@show');
Route::get('/lists/{load_order:slug}/download/{file}', 'DownloadController@index');
Route::delete('/lists/{load_order:slug}', 'LoadOrderController@destroy');


// Comparison Routes.
Route::get('/compare', 'ComparisonController@index')->name('compare');
Route::post('/compare', 'ComparisonController@post')->name('compare.post');
Route::get('/compare/{load_order}/{load_order2}', 'ComparisonController@results')->name('compare.results');

// User account management routes
Route::get('/profile', 'UserController@index')->middleware(['auth', 'password.confirm'])->name('user.profile');
Route::post('/user/delete', 'UserController@destroy')->name('user.delete-account');

// Admin routes
Route::get('admin/stats', 'AdminController@stats')->name('admin.stats');
Route::get('admin/users', 'AdminController@users')->name('admin.users');
Route::post('admin/users/verify/{user:id}', 'AdminController@verify')->name('admin.users.verify');
Route::get('/admin/backups', 'AdminController@backups')->name('admin.backup');
Route::get('/admin/backups/download/{id}', 'AdminController@downloadBackup')->name('admin.download-backup');
Route::delete('/admin/backups/delete/{id}', 'AdminController@deleteBackup')->name('admin.delete-backup');


// Intentional error routes for testing purposes.
Route::get('/errors/500', 'IntentionalErrorsController@http500')->name('error.500');




