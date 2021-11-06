<?php

Route::get('/', function () {
	return redirect()->route('admin.login');

});
Route::group(['prefix' => 'online-pay'], function() {
   Route::get('/', 'OnlinePaymentController@index')->name('payment.form');  
   Route::get('completed/{id}', 'OnlinePaymentController@completed')->name('payment.completed');  
   Route::get('failed', 'OnlinePaymentController@paymentFailed')->name('payment.failed');  
   Route::post('payment-store', 'OnlinePaymentController@store')->name('payment.store');  
   Route::post('/paytm-callback', 'OnlinePaymentController@paytmCallback');
});
Route::get('login', 'Auth\LoginController@login')->name('admin.login'); 
Route::get('refresh-captcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha'); 
Route::post('login', 'Auth\LoginController@logout')->name('admin.logout.post'); 
Route::get('register', 'Auth\LoginController@register')->name('admin.register');
Route::post('register-store', 'Auth\LoginController@registerStore')->name('admin.register.store');
Route::get('otp-verify/{user_id}', 'Auth\LoginController@OtpVerify')->name('admin.otp.verify');
Route::post('otp-v-store/{otp_type}', 'Auth\LoginController@OtpVerifyStore')->name('admin.otp.verify.store');
Route::get('re-send-otp/{user_id}/{user_type}', 'Auth\LoginController@reSendOtp')->name('admin.otp.resend');
Route::post('login-post', 'Auth\LoginController@loginPost')->name('admin.login.post');


Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('add-new-user', 'DashboardController@addNewUser')->name('admin.add.new.user');
	Route::post('add-new-user-store', 'DashboardController@addNewUserStore')->name('admin.add.new.user.store');
	Route::get('user list', 'DashboardController@userList')->name('admin.user.list');
	Route::get('booking', 'DashboardController@booking')->name('admin.booking'); 
	Route::post('booking-store', 'DashboardController@bookingStore')->name('admin.booking.store'); 
	Route::get('payment-option', 'DashboardController@paymentOption')->name('admin.payment.option'); 
	Route::get('payment-option-form', 'DashboardController@paymentOptionForm')->name('admin.payment.option.form'); 
	Route::post('payment-option-store', 'DashboardController@paymentOptionStore')->name('admin.payment.option.store'); 
	Route::get('payment-option-status/{id}', 'DashboardController@paymentOptionStatus')->name('admin.payment.option.status'); 
	Route::get('payment', 'DashboardController@payment')->name('admin.payment'); 
	Route::get('qrcode', 'DashboardController@qrcode')->name('admin.qrcode'); 
	Route::get('qrcode-show/{path}', 'DashboardController@qrcodeShow')->name('admin.qrcode.show'); 

});


