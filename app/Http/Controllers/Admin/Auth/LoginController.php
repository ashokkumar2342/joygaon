<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

  
  
  public function login(){
      return view('admin.login');
  }
  public function register(){
      return view('admin.register');
  }
  public function OtpVerify($user_id)
  {
    $user_id = Crypt::decrypt($user_id);
    $result_rs = DB::select(DB::raw("select * from `users` where `id` = '$user_id' limit 1;"));
    $result_rs = reset($result_rs);
    $email_id = $result_rs->email_id;
    $mobile_no = $result_rs->mobile_no;
    $email_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` = 1 limit 1;"));
    $mobile_rs = DB::select(DB::raw("select * from `user_otp` where `user_id` = $user_id and `otp_type` =2 limit 1;"));
    return view('admin.otp_verify',compact('mobile_rs','email_rs', 'user_id'));
  }
  public function registerStore(Request $request)
  {
    try {
        $this->validate($request, [ 
         "name" => 'required|string|min:2|max:50',             
         "email_id" => 'required|email|unique:users|max:100', 
         "mobile_no" => 'required|unique:users|numeric|digits:10',
         "password" => 'required|min:6|max:15', 
         "retype_password" => 'required|min:6|max:15',
        ]);
        $email_otp = random_int(100000, 999999); 
        $mobile_otp = random_int(100000, 999999); 
        if($request->password != $request->retype_password){
          return Redirect()->back()->with(['message'=>'Passwords Not Match','class'=>'error']); 
        }
        $en_password = bcrypt($request['password']);
        DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`,`role_id`, `created_by`,`status`) Values ('$request->name', '$request->email_id', '$request->mobile_no', '$en_password',4,0,0);"));

        $new_user_id=DB::select(DB::raw("select `status`,`id` from `users` where `mobile_no`='$request->mobile_no'"));
        $user_id=$new_user_id[0]->id;
        $email_sv_otp=DB::select(DB::raw("Insert Into `user_otp` (`user_id`, `otp`, `otp_type`, `status`) Values ('$user_id', '$email_otp',1,0);"));
        $mobile_sv_otp=DB::select(DB::raw("Insert Into `user_otp` (`user_id`, `otp`, `otp_type`, `status`) Values ('$user_id', '$mobile_otp',2,0);")); 
        if ($new_user_id[0]->status==0) {
        return redirect()->route('admin.otp.verify',Crypt::encrypt($user_id))->with(['message'=>'Registration Successfully','class'=>'success']); 
        }else{
        return Redirect()->back()->with(['message'=>'Something Went Wrong','class'=>'error']);
        }
        }catch (Exception $e){ 
      }
    
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
              return redirect()->route('admin.login')->with(['class'=>'success','message'=>'EMail Otp Verified Successfully']);
            }
              return redirect()->back()->with(['class'=>'success','message'=>'EMail Otp Verified Successfully']);      
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
              return redirect()->route('admin.login')->with(['class'=>'success','message'=>'Mobile Otp Verified Successfully']);
            }
            return redirect()->back()->with(['class'=>'success','message'=>'Mobile Otp Verified Successfully']);      
          }
        } 
       
    
    return redirect()->back()->with(['class'=>'error','message'=>'Invalid OTP, Please Try Again']);
  }
    
  public function loginPost(Request $request)
  { 
    $this->validate($request, [
    'email' => 'required', 
    'password' => 'required',
              
    ]);
    $credentials = [
    'email_id' => $request['email'],
    'password' => $request['password'],
    'status' => 1,
    ];  
    if(auth()->guard('user')->attempt($credentials)) {
      
        return redirect()->route('admin.dashboard');
               
    } 

    return Redirect()->back()->with(['message'=>'Invalid User or Password','class'=>'error']); 
    
  }
  public function logout(){
    Session::flush();
    return redirect()->route('admin.login');
  }

    
    
}
