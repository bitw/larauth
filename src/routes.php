<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 25.05.2014
 * Time: 22:33
 */

Route::group(['before'=>'guest'], function(){

	Route::get('/logon', ['as'=>'larauth.logon', 'uses'=>'LarauthController@getLogon']);
	Route::post('/logon', ['as'=>'larauth.logon', 'uses'=>'LarauthController@postLogon']);

	Route::get('/registration', ['as'=>'larauth.registration', 'uses'=>'LarauthController@getRegistration']);
	Route::post('/registration', ['as'=>'larauth.registration', 'uses'=>'LarauthController@postRegistration']);

	Route::match(['GET', 'POST'], '/activation/{code?}', ['as'=>'larauth.activation', 'uses'=>'LarauthController@getActivation']);

	Route::get('/requestcode', ['as'=>'larauth.requestcode', 'uses'=>'LarauthController@getRequestCode']);
	Route::post('/requestcode', ['as'=>'larauth.requestcode', 'uses'=>'LarauthController@postRequestCode']);

	Route::get('/forgot', ['as'=>'larauth.forgot_password', 'uses'=>'LarauthController@getForgotPassword']);
	Route::post('/forgot', ['as'=>'larauth.forgot_password', 'uses'=>'LarauthController@postForgotPassword']);

    Route::get('/newpassword/{email}/{key}', ['as'=>'larauth.new_password', 'uses'=>'LarauthController@getNewPassword']);
    Route::post('/newpassword/{email}/{key}', ['as'=>'larauth.new_password', 'uses'=>'LarauthController@postNewPassword']);
});

Route::group(['before'=>'auth|csrf'], function(){
    Route::get('/logout', ['as'=>'larauth.logout', 'uses'=>'LarauthController@getLogout']);
});