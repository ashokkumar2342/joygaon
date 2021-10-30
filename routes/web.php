<?php

Route::get('/', function () {
	return redirect()->route('admin.login');

});
Route::get('login', 'Auth\LoginController@login')->name('admin.login'); 
Route::post('login', 'Auth\LoginController@logout')->name('admin.logout.post'); 
Route::get('register', 'Auth\LoginController@register')->name('admin.register');
Route::post('register-store', 'Auth\LoginController@registerStore')->name('admin.register.store');
Route::get('otp-verify/{user_id}', 'Auth\LoginController@OtpVerify')->name('admin.otp.verify');
Route::post('otp-v-store/{otp_type}', 'Auth\LoginController@OtpVerifyStore')->name('admin.otp.verify.store');
Route::post('login-post', 'Auth\LoginController@loginPost')->name('admin.login.post');


Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('add-new-user', 'DashboardController@addNewUser')->name('admin.add.new.user');
	Route::post('add-new-user-store', 'DashboardController@addNewUserStore')->name('admin.add.new.user.store');
	Route::get('booking', 'DashboardController@booking')->name('admin.booking'); 

});


