<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */



Auth::routes();

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');
Route::get('/home', 'HomeController@index');

Route::get('/edit-profile', ['middleware' => ['auth'], 'uses' => 'MottoController@index', function() {
return view('users.editprofile');
}])->name('edit-profile');
Route::get('/profile1', ['middleware' => ['auth'], 'uses' => 'MottoController@view', function() {
return view('users.profile');
}])->name('profile');

Route::post('/update-profile', ['middleware' => ['auth'], 'uses' => 'UserController@storeDetails', function() {
return view('users.profile');
}])->name('view-profile');

Route::post('/edit-profile-pic', ['middleware' => ['auth'], 'uses' => 'UserController@store']);



Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost', ['as' => 'resizeImagePost', 'uses' => 'ImageController@resizeImagePost']);
