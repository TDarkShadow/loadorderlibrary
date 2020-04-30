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

Route::get('/lists', 'LoadOrderController@index')->name('lists');
Route::get('/upload', 'LoadOrderController@create')->name('upload');
Route::post('/upload', 'LoadOrderController@store')->name('upload.store');
Route::get('/lists/{load_order:slug}', 'LoadOrderController@show');
Route::delete('/lists/{load_order:slug}', 'LoadOrderController@destroy');
// TODO: deleted/edit. 



