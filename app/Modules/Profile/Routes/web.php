<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your module. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */
 Route::get('/', 'Profile@indexAction');
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'Profile@indexAction');
    Route::post('/user', 'Profile@userProfileViewAction');
    Route::get('/message/{token}', 'Profile@userMessageViewAction');
    Route::post('/profileImageUpload', 'Profile@profileImageUploadAction');
    Route::post('/profileImageCrop', 'Profile@profileImageCropAction');
    Route::post('/sendMessage', 'Profile@sendMessageAction');
});
