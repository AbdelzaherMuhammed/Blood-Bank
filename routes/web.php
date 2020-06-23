<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| making custom middleware auth->guard->check
*/
Route::group(['namespace' => 'Front' ],function() {

    Route::get('/', 'MainController@home')->name('client-home');
    Route::get('client-register', 'AuthController@register')->name('client-register');
    Route::post('client-register', 'AuthController@registerSave')->name('register-submit');
    Route::get('forget-password' , 'AuthController@forgetPassword')->name('forget-password');
    Route::post('reset-password' , 'AuthController@resetPassword')->name('reset-password');
    Route::get('new-password' , 'AuthController@newPassword')->name('new-password');
    Route::post('new-password' , 'AuthController@newPasswordConfirm')->name('new-password-confirm');
    Route::get('about' , 'MainController@about')->name('about');
    Route::get('search' , 'MainController@search')->name('search');

    Route::group(['middleware' => 'auth:client-web'] , function (){

        Route::post('toggle-favourite' , 'MainController@toggleFavourite')->name('toggle-favourite');
        Route::get('posts' , 'MainController@posts')->name('posts');
        Route::get('post' , 'MainController@post')->name('post');
        Route::get('post/favourites' , 'MainController@myFavourites')->name('post-favourite');
        Route::get('post-details/{id}' , 'MainController@postDetails')->name('post-details');
        Route::get('contact' , 'MainController@contact')->name('contact');
        Route::post('contact-send' , 'MainController@contactSend')->name('contact-send');
        Route::get('donation' , 'MainController@donation')->name('donation');
        Route::get('donation-details/{id}' , 'MainController@donationDetails')->name('donation-details');
        Route::get('donation-request' , 'MainController@donationRequest')->name('donation-request');
        Route::post('donation-request' , 'MainController@donationConfirm')->name('donation-confirm');
        Route::get('profile/{id}' , 'MainController@profile')->name('client-profile');
        Route::post('client/profile/{id}' , 'MainController@profileUpdate')->name('profile-update');
        Route::get('home/search' , 'MainController@homeSearch')->name('home-search');
        Route::get('donation/search' , 'MainController@donationSearch')->name('donation-search');

    });
});

//client login routes
Route::get('client-login' , 'Auth\ClientLoginController@login')->name('client-login');
Route::post('client-login', 'Auth\ClientLoginController@loginSave')->name('client-submit');
Route::get('logout', 'Auth\ClientLoginController@logout')->name('client-logout');


Auth::routes();
Route::get('admin/logout' , 'Auth\loginController@userLogout')->name('admin-logout');

Route::group(['middleware' =>  ['auth' , 'auto-check-permission'] ,'prefix' => 'admin'] , function (){


        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('governorate' , 'GovernorateController');
        Route::resource('city' , 'CityController');
        Route::resource('category' , 'CategoryController');
        Route::resource('post' , 'PostController');
        Route::resource('client' , 'ClientController');
        Route::get('change/status/{id}' , 'ClientController@changeStatus')->name('change-status');
        Route::get('user/change-password' , 'UserController@changePassword');
        Route::post('user/update-password' , 'UserController@updatePassword');
        Route::resource('contact','ContactController');
        Route::resource('donation','DonationRequestController');
        Route::resource('setting' , 'SettingsController');
        Route::resource('user' , 'UserController');
        Route::resource('role' , 'RoleController');

        //search
        Route::get('post-search' , 'PostController@search')->name('post-search');
        Route::get('category-search' , 'CategoryController@search')->name('category-search');
        Route::get('governorate-search' , 'GovernorateController@search')->name('governorate-search');
        Route::get('city-search' , 'CityController@search')->name('city-search');
        Route::get('user-search' , 'UserController@search')->name('user-search');
        Route::get('client-filter' , 'ClientController@filter')->name('client-filter');
        Route::get('donation-filter' , 'DonationRequestController@filter')->name('donation-filter');

});

