<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Events\SmsEvent;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Helper\MyFuncs;
class LoginController extends Controller
{
   

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */

  // protected $redirectTo = '/admin/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('admin.guest')->except('logout');
  }




  public function reSendOtp(Request $request,$user_id,$otp_type)
  {
    $rs_otp = random_int(100000, 999999);
    $update_rs = DB::select(DB::raw("update `user_otp` set `otp` = $rs_otp where `user_id` = $user_id and `otp_type`= $otp_type limit 1;"));
    $user_rs = DB::select(DB::raw("select * from `users` where `id`= $user_id limit 1 ")); 
    if ($otp_type==1) {
      $data = array( 'email' => $user_rs[0]->email_id, 'otp' => $rs_otp, 'from' => 'info@joygaon.in', 'from_name' => 'Joygaon' );
      Mail::send('emails.mail_otp', $data, function( $message ) use ($data)
      {
        $message->to( $data['email'] )->from( $data['from'], 'Joygaon' )->subject( 'Code Verification!' );
      });
      
    }else{
      $message = $rs_otp.' is the Verification code for registration on joygaon. EXCELNET';
      $tempid ='1707163663440740652';
      event(new SmsEvent($user_rs[0]->mobile_no,$message,$tempid));
    }
    return redirect()->back()->with(['message'=>'Code Resend Successfully.','class'=>'success']); 
  }
  

  public function loginPost(Request $request)
  { 
    $this->validate($request, [
    'email_or_phone' => 'required', 
    'password' => 'required',
    'captcha' => 'required|captcha',
              
    ]);

    $email_mobile = MyFuncs::removeSpacialChr($request->email_or_phone);
    $date=date('Y-m-d'); 
    $email_rs = DB::select(DB::raw("select * from `users` where `email_id` = '$email_mobile' or `mobile_no` = '$email_mobile' limit 1;"));
    if (!empty($email_rs)) {
      if ($email_rs[0]->status==0) {
        return redirect()->route('admin.otp.verify',Crypt::encrypt($email_rs[0]->id));
      }

      $credentials = [
        'email_id' => $request['email_or_phone'],
        'password' => $request['password'],
        'status' => 1,
      ]; 
      if(auth()->guard('user')->attempt($credentials)) {
        $result_rs = DB::select(DB::raw("update `users` set `last_login` = '$date' where `email_id` ='$email_mobile' limit 1;"));
        return redirect()->route('admin.dashboard');        
      }

      $credentials = [
        'mobile_no' => $request['email_or_phone'],
        'password' => $request['password'],
        'status' => 1,
      ]; 
      if(auth()->guard('user')->attempt($credentials)) {
        $result_rs = DB::select(DB::raw("update `users` set `last_login` = '$date' where `mobile_no` ='$email_mobile' limit 1;"));
        return redirect()->route('admin.dashboard');        
      } 
    }  
    return Redirect()->back()->with(['message'=>'Invalid User or Password','class'=>'error']); 
  }
  

  public function OtpVerifyStore(Request $request ,$otp_type)
  {
    $otp_type = Crypt::decrypt($otp_type);
    $user_id = $request->user_id;
    if ($otp_type==1) { 
      $this->validate($request,[                
        'email_otp' => 'required|numeric',  
      ]);

      $email_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` = 1 and `otp` = $request->email_otp limit 1;"));
      $count_rs = count($email_rs); 
      if ($count_rs >= 1) {
        $update_rs = DB::select(DB::raw("update `user_otp` set `status` = 1 where `user_id` = $user_id and `otp_type` = 1 limit 1;")); 
            
        $result_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `status` = 1 limit 2;"));
        $count_rs = count($result_rs); 
        if($count_rs == 2){
          $update_rs = DB::select(DB::raw("update `users` set `status` = 1 where `id` = $user_id limit 1;"));
          return redirect()->route('admin.login')->with(['class'=>'success','message'=>'EMail Code Verified Successfully']);
        }
        return redirect()->back()->with(['class'=>'success','message'=>'EMail Code Verified Successfully']);      
      }
    }
    
    if ($otp_type==2) {
      $this->validate($request,[                
        'mobile_otp' => 'required|numeric',  
      ]);
      $email_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` = 2 and `otp` = $request->mobile_otp limit 1;"));
      $count_rs = count($email_rs); 
      if ($count_rs >= 1) {
        $update_rs = DB::select(DB::raw("update `user_otp` set `status` = 1 where `user_id` = $user_id and `otp_type` = 2 limit 1;")); 
        
        $result_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `status` = 1 limit 2;"));
        $count_rs = count($result_rs); 
        if($count_rs == 2){
          $update_rs = DB::select(DB::raw("update `users` set `status` = 1 where `id` = $user_id limit 1;"));
          return redirect()->route('admin.login')->with(['class'=>'success','message'=>'Mobile Code Verified Successfully']);
        }
        return redirect()->back()->with(['class'=>'success','message'=>'Mobile Code Verified Successfully']);      
      }
    } 
    return redirect()->back()->with(['class'=>'error','message'=>'Invalid Code, Please Try Again']);
  }
  

  public function OtpVerify($user_id)
  {
    $user_id = Crypt::decrypt($user_id);
    $result_rs = DB::select(DB::raw("select * from `users` where `id` = '$user_id' limit 1;"));
    $result_rs = reset($result_rs);
    $email_id = $result_rs->email_id;
    $mobile_no = $result_rs->mobile_no;
    $email_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` = 1 limit 1;"));
    $mobile_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` = 2 limit 1;"));
    return view('admin.otp_verify',compact('mobile_rs', 'email_rs', 'user_id', 'email_id', 'mobile_no'));
  }
  
  public function registerStore(Request $request)
  {
    try {
      $this->validate($request, [ 
        "name" => 'required|string|min:2|max:100',             
        "email_id" => 'required|email|unique:users|max:100|min:5', 
        "mobile_no" => 'required|unique:users|numeric|digits:10',
        "password" => 'required|min:6|max:15', 
        "confirm_password" => 'required|min:6|max:15|same:password',
        'captcha' => 'required|captcha',
      ]);

      if($request->password != $request->confirm_password){
        return Redirect()->back()->with(['message'=>'Passwords|Confirm Password Not Match','class'=>'error']); 
      }
      
      $en_password = bcrypt($request['password']);
      $new_name = MyFuncs::removeSpacialChr($request->name);
      $new_email = MyFuncs::removeSpacialChr($request->email_id);

      DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`, `role_id`, `created_by`, `status`) Values ('$new_name', '$new_email', '$request->mobile_no', '$en_password', 4, 0, 0);"));


      //Code To Genderate and save verification Code
      $email_otp = random_int(100000, 999999); 
      $mobile_otp = random_int(100000, 999999); 
        
      $new_user_id=DB::select(DB::raw("select `status`,`id` from `users` where `mobile_no`='$request->mobile_no'"));
      $user_id=$new_user_id[0]->id;
        
      $email_sv_otp=DB::select(DB::raw("Insert Into `user_otp` (`user_id`, `otp`, `otp_type`, `status`) Values ('$user_id', '$email_otp',1,0);"));
      $mobile_sv_otp=DB::select(DB::raw("Insert Into `user_otp` (`user_id`, `otp`, `otp_type`, `status`) Values ('$user_id', '$mobile_otp',2,0);")); 
        
      //Code To Send Mobile Verification Code
      $message = $mobile_otp.' is the Verification code for registration on joygaon. EXCELNET';
      $tempid ='1707163663440740652'; 
      event(new SmsEvent($request->mobile_no,$message,$tempid));
        
      #send email
      $data = array( 'email' => $request->email_id, 'otp' =>  $email_otp, 'from' => 'info@joygaon.in', 'from_name' => 'Joygaon' );
      Mail::send('emails.mail_otp', $data, function( $message ) use ($data)
      {
        $message->to( $data['email'] )->from( $data['from'], 'Joygaon' )->subject( 'Code Verification!' );
      });

      return redirect()->route('admin.otp.verify',Crypt::encrypt($user_id))->with(['message'=>'Registration Successfully','class'=>'success']); 
        
    }catch (Exception $e){ }
  }
  
  public function refreshCaptcha()
  {  
    return  captcha_img('flat');
  }

  public function register(){
    return view('admin.register');
  }
    
  
  public function login(){
    return view('admin.login');
  }





  
  
  public function forgotPassword()
  {
   return view('admin.forgot_password');
  }

  public function forgotPasswordSendLink(Request $request)
  {
    $this->validate($request, [
    'email_or_phone' => 'required', 
    ]);
   
    $email_mobile = str_replace("'", "", trim($request->email_or_phone));
    $user=DB::select(DB::raw("select * from `users` where `email_id` = '$email_mobile' or `mobile_no` = '$email_mobile' limit 1;")); 
    
    if (!empty($user)) {
      if ($user[0]->status==0) {
          return redirect()->route('admin.otp.verify',Crypt::encrypt($user[0]->id));
      }
      else{
        
        $data = array( 'link' => route('admin.forgot.password.reset',Crypt::encrypt($user[0]->email_id)),'user_name' => $user[0]->name,'email' => $user[0]->email_id, 'from' => 'info@joygaon.in', 'from_name' => 'Joygaon' );
        Mail::send('emails.forgotPassword', $data, function( $message ) use ($data)
        {
          $message->to($data['email'] )->from( $data['from'], 'Joygaon' )->subject( 'Forgot Password' );
        });
      }
        return redirect()->back()->with(['message'=>'Link Send Successfully','class'=>'success']);
    } 
    
    
      
    return Redirect()->back()->with(['message'=>'Invalid User','class'=>'error']); 
    
  }
  public function forgotPasswordReset($email)
  {
    $email = Crypt::decrypt($email); 
    
    $user=DB::select(DB::raw("select * from `users` where `email_id` = '$email' limit 1;")); 
    
    if (!empty($user)) {
      return view('admin.reset_password',compact('email'));
    }  
    return Redirect()->back()->with(['message'=>'Invalid Link','class'=>'error']); 
    
  }
  public function forgotPasswordResetSave(Request $request ,$email)
  {
      $this->validate($request, [
      'password'=> 'required|min:6|max:15',
      'confirm_password'=> 'required|min:6|max:15|same:password',
      ]); 
      $email = Crypt::decrypt($email); 
      $password=bcrypt($request['password']); 
      $user_rs = DB::select(DB::raw("update `users` set `password` ='$password' where `email_id` ='$email' limit 1")); 
      return redirect()->route('admin.login')->with(['message'=>'Password Reset Successfully','class'=>'success']); 
  }
  
  public function logout(){
    Session::flush();
    return redirect()->route('admin.login');
  }

    
    
}
