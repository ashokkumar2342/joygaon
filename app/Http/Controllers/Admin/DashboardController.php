<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\Crypt;  
use Illuminate\Support\Facades\Response;  

class DashboardController extends Controller
{
    public function index()
    {   	
       	try{ 
       		return view('admin.dashboard'); 
       	}catch (Exception $e) {
       	
       	}
    }
    public function addNewUser()
    {
    	try{

    		$roles = DB::select(DB::raw("select * from `role_type` order by `id`")); 
    		return view('admin.UserManagements.add_new_user' ,compact('roles')); 
    	}catch (Exception $e) {
    		
    	}
    }
    public function addNewUserStore(Request $request)
    {
    	try {
    		$rules=[
            'name' => 'required|string|min:2|max:50',             
            'email_id' => 'required|email|unique:users',
            "mobile_no" => 'required|unique:users|numeric|digits:10',
            "role_id" => 'required',
            "password" => 'required|min:6|max:15', 
            "retype_password" => 'required|min:6|max:15', 
        	];

	        $validator = Validator::make($request->all(),$rules);
	        if ($validator->fails()) {
	            $errors = $validator->errors()->all();
	            $response=array();
	            $response["status"]=0;
	            $response["msg"]=$errors[0];
	            return response()->json($response);// response as json
	        }
	        if($request->password != $request->retype_password){
         		$response=['status'=>0,'msg'=>'Passwords Not Match'];
	        	return response()->json($response);
    		}
	        $admin=Auth::guard('user')->user(); 
	        $en_password = bcrypt($request['password']);
	        DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`,`role_id`, `created_by`,`status`) Values ('$request->name', '$request->email_id', '$request->mobile_no', '$en_password',$request->role_id,$admin->id,0);"));

	        $response=['status'=>1,'msg'=>'Account Created Successfully'];
	        return response()->json($response);   
    	 
    	}catch (Exception $e) {
    		
    	}
    }
    public function userList()
    {
      try{
          $userlists = DB::select(DB::raw("select * from `users` order by `name`"));
          return view('admin.UserManagements.user_list',compact('userlists'));
          }catch (Exception $e) {
        
        }
    }
    public function booking()
    {
      try{  
          $bookingTypes = DB::select(DB::raw("select * from `booking_type` order by `id`"));
          $paymentModes = DB::select(DB::raw("select * from `payment_mode` order by `id`"));
          return view('admin.booking.booking',compact('bookingTypes','paymentModes')); 
        }catch (Exception $e) {
        
        }
    }
    
    public function paymentOption()
    {
        $user=Auth::guard('user')->user();
        $user_id=$user->id;
        $paymentModes=DB::select(DB::raw("select * from `payment_mode` order by `id`")); 
        $paymentOptions = DB::select(DB::raw("select `po`.`id`,`po`.`qr_code`,`po`.`status`,`po`.`account_no`,`po`.`ifsc_code`,`po`.`account_name`, `pm`.`name` from `payment_option` `po` inner join `payment_mode` `pm` on `pm`.`id` = `po`.`payment_mode_id` where `po`.`user_id` = $user_id;"));  
        return view('admin.booking.payment_option',compact('paymentModes','paymentOptions'));
    }
    public function paymentOptionForm(Request $request)
    {
        $paymentmodeid=$request->id;
       return view('admin.booking.payment_option_form',compact('paymentmodeid'));
    } 
    public function paymentStatus()
    {
      $user=Auth::guard('user')->user(); 
      $paymentStatus = DB::select(DB::raw("select `op`.`order_id`,`op`.`booking_id`,`op`.`amount`,`op`.`status`,`book`.`adults`,`book`.`children`,`book`.`booking_date` from `online_payments` `op` inner join `booking` `book` on `book`.`user_id`=$user->id ")); 
      return view('admin.booking.payment',compact('paymentStatus'));
    }
    public function qrcode(Request $request)
    {
        $payment_mode_id =$request->id;
        $user=Auth::guard('user')->user(); 
        $paymentOptions = DB::select(DB::raw("select `po`.`id`,`po`.`qr_code`,`po`.`status`,`po`.`account_no`,`po`.`ifsc_code`,`po`.`account_name`, `pm`.`name` from `payment_option` `po` inner join `payment_mode` `pm` on `pm`.`id` = `po`.`payment_mode_id` where `po`.`user_id` = $user->created_by and  `po`.`payment_mode_id` =$payment_mode_id and `status` =1;")); 
       return view('admin.booking.payment_option_show',compact('paymentOptions','payment_mode_id'));
    }
    public function qrcodeShow(Request $request,$path)
    {  
      $path=Crypt::decrypt($path);
      $storagePath = storage_path('app/'.$path);              
      $mimeType = mime_content_type($storagePath); 
      if( ! \File::exists($storagePath)){

        return view('error.home');
      }
      $headers = array(
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; '
      );            
      return Response::make(file_get_contents($storagePath), 200, $headers);     
    }
    public function printTicket($value='')
    {
      return view('admin.booking.print_ticket',compact('paymentModes'));
    }
    public function attendance()
    {
      return view('admin.booking.attendance',compact('paymentModes'));
    }
    public function attendanceBarcode(Request $request)
    {
      return $request;
    }
    
}
