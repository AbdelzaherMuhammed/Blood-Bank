<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1' , 'namespace' => 'Api'] , function (){

    Route::post('register','AuthController@register');
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::post('login','AuthController@login');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@newPassword');
    Route::get('test-notification' , 'MainController@testNotification');


    Route::group(['middleware' => 'auth:api'],function(){
        Route::get('blood-types','MainController@bloodTypes');
        Route::get('posts','MainController@posts');
        Route::get('posts-details','MainController@postDetails');
        Route::post('post-favourite','MainController@postFavourite');
        Route::get('my-favourits','MainController@myFavoutits');
        Route::get('categories','MainController@categories');
        Route::get('contact-us','MainController@contactUs');
        Route::get('about-us','MainController@aboutUs');
        Route::post('profile','MainController@profile');
        Route::post('notification-settings','MainController@notificationSettings');
        Route::get('list-of-donations','MainController@donations');
        Route::get('donation-details' , 'MainController@donationDetails');
        Route::get('notification-list' , 'MainController@notificationList');
        Route::post('create-donation-request','MainController@CreateDonations');
        Route::post('register-notification-token' , 'AuthController@registerToken');
        Route::get('remove-notification-token' , 'AuthController@removeToken');



    });

});
