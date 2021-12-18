<?php

Route::get('/', function () {
	return redirect()->route('front.index');	//OK---------

});



Route::get('index', 'Front\FrontController@index')->name('front.index'); //OK-------
Route::get('booknow', 'Front\FrontController@booknowF')->name('front.booknow'); //OK-------
Route::get('mob-form', 'Front\FrontController@mobileForm')->name('front.mobile.form'); //OK-------
Route::post('mob-verify', 'Front\FrontController@mobileVerify')->name('front.mobile.verify'); //OK-------
Route::get('mob-verify-form/{mobile_no}', 'Front\FrontController@mobileVerifyForm')->name('front.mobile.verify.form'); //OK-------
Route::post('mob-verify-store', 'Front\FrontController@mobileVerifyStore')->name('front.mobile.verify.store'); //OK-------
Route::get('booking-form/{mobile_no}', 'Front\FrontController@bookingForm')->name('front.booking.form'); //OK-------
Route::get('code-resend/{mobile_no}', 'Front\FrontController@codeResend')->name('front.code.resend'); //OK-------
Route::get('download-ticket/{order_id}', 'Front\FrontController@downloadTicket')->name('front.download.ticket'); //OK-------
Route::get('bivents-booking', 'Front\FrontController@biventsBooking')->name('front.bivents.booking'); //OK-------
Route::get('download-form', 'Front\FrontController@biventsBooking')->name('front.bivents.booking'); //OK-------

Route::get('about', 'Front\FrontController@about')->name('front.about'); //OK-------
Route::get('gallery', 'Front\FrontController@gallery')->name('front.gallery'); //OK-------
Route::get('price-list', 'Front\FrontController@priceList')->name('front.price.list'); //OK-------
Route::get('cotact-us', 'Front\FrontController@cotactus')->name('front.cotactus'); //OK-------

Route::post('booking-store', 'Front\FrontController@bookingstore')->name('front.booking.store'); //OK-------
Route::get('login', 'Auth\LoginController@login')->name('admin.login'); //OK-------
Route::get('refresh-captcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha'); 	//OK----


Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout.post'); 


Route::get('register', 'Auth\LoginController@register')->name('admin.register');	//OK---------
Route::post('register-store', 'Auth\LoginController@registerStore')->name('admin.register.store');		//OK--------
Route::get('otp-verify/{user_id}', 'Auth\LoginController@OtpVerify')->name('admin.otp.verify');	//OK-------
Route::post('otp-v-store/{otp_type}', 'Auth\LoginController@OtpVerifyStore')->name('admin.otp.verify.store');	//OK------
Route::get('re-send-otp/{user_id}/{user_type}', 'Auth\LoginController@reSendOtp')->name('admin.otp.resend');	//OK-------
Route::post('login-post', 'Auth\LoginController@loginPost')->name('admin.login.post');	//OK---------

Route::get('forgot-password', 'Auth\LoginController@forgotPassword')->name('admin.forgot.password');
Route::post('forgot-password-send-link', 'Auth\LoginController@forgotPasswordSendLink')->name('admin.forgot.password.send.link');
Route::get('forgot-password-reset/{email}', 'Auth\LoginController@forgotPasswordReset')->name('admin.forgot.password.reset');
Route::post('forgot-password-reset-save/{email}', 'Auth\LoginController@forgotPasswordResetSave')->name('admin.forgot.password.reset.save');


Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');	//OK------------

	Route::get('change-password', 'DashboardController@changePassword')->name('admin.change.password');
	Route::post('change-password-store', 'DashboardController@changePasswordStore')->name('admin.change.password.store');
	Route::get('add-new-user', 'DashboardController@addNewUser')->name('admin.add.new.user');
	Route::post('add-new-user-store', 'DashboardController@addNewUserStore')->name('admin.add.new.user.store');
	Route::get('user-list', 'DashboardController@userList')->name('admin.user.list');
	Route::get('check-amount', 'DashboardController@checkAmount')->name('admin.check.amount'); 

	Route::get('payment-status', 'BookingController@BookingStatus')->name('admin.booking.status'); 	//OK--------------
	
	Route::get('pay-again/{bookin_id}', 'OnlinePaymentController@payAgain')->name('admin.pay.again');//OK------
	Route::get('manual-payment/{bookin_id}', 'OnlinePaymentController@manualPayment')->name('admin.manual.payment');//OK------
	Route::get('attendance', 'DashboardController@attendance')->name('admin.attendance'); 		//OK--------
	Route::get('attendance-barcode', 'DashboardController@attendanceBarcode')->name('admin.attendance.barcode'); 	//OK--------
	Route::post('attendance-store', 'DashboardController@attendanceStore')->name('admin.attendance.store'); 	//OK--------
	Route::get('print-ticket/{order_id?}', 'OnlinePaymentController@printTicket')->name('admin.print.ticket'); 
	Route::get('download-ticket/{order_id?}', 'BookingController@downloadTicket')->name('admin.download.ticket'); 
	Route::get('report', 'BookingController@report')->name('admin.report'); 
	Route::post('report-post', 'BookingController@reportPost')->name('admin.report.post'); 
	Route::get('payment-history', 'BookingController@paymentHistory')->name('admin.payment.history'); 
	Route::post('payment-history-show', 'BookingController@paymentHistoryShow')->name('admin.payment.history.show'); 
	Route::get('generate-coupon', 'BookingController@generateCoupon')->name('admin.generate.coupon');
	Route::post('coupon-post', 'BookingController@couponPost')->name('admin.coupon.post'); 
	
	


	Route::get('booking', 'BookingController@showBookingForm')->name('admin.booking'); 	//OK-------------


	Route::group(['prefix' => 'online-pay'], function() {
   		Route::get('/', 'OnlinePaymentController@index')->name('payment.form');  
   		Route::get('completed/{id}', 'OnlinePaymentController@completed')->name('payment.completed');  
   		Route::get('failed', 'OnlinePaymentController@paymentFailed')->name('payment.failed');  

   		Route::post('payment-store', 'BookingController@storeBooking')->name('admin.booking.store'); 	//OK------------

   		Route::post('/paytm-callback', 'OnlinePaymentController@paytmCallback');
	});
});

Route::group(['prefix' => 'front-pay'], function() {
		Route::get('/', 'Front\FrontController@index')->name('front.payment.form');  
		Route::get('completed/{id}', 'Front\FrontController@completed')->name('front.payment.completed');  
		Route::get('failed', 'Front\FrontController@paymentFailed')->name('front.payment.failed');   

		Route::post('/paytm-callback', 'Front\FrontController@paytmCallback');
});




