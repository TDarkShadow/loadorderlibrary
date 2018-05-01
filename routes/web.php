<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
	
Route::Auth();

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/upload', 'UploadController@index')->name('guest-upload');
Route::post('/upload', 'UploadController@store')->name('guest-upload-store');

Route::get('/lo', 'LoadOrderController@index');
Route::get('/lo/{slug}', 'LoadOrderController@show');
Route::get('/lo/{slug}/edit', 'LoadOrderController@edit'); //check if logged in is owner
Route::put('/lo/{slug}/edit', 'LoadOrderController@update'); //check if logged in is owner
Route::delete('/lo/{slug}/delete', 'LoadOrderController@destroy'); //check if logged in is owner

Route::get('/u/{username}', 'UserController@show')->name('user-view'); 
Route::get('/u/{username}/settings', 'UserController@edit')->name('user-edit'); //check if logged in is owner
Route::get('/u/{username}/delete-account', 'UserController@confirmDestroy')->name('user-delete-confirm');
Route::delete('/u/{username}/delete-account', 'UserController@destroy')->name('user-delete'); //check if logged in is owner
