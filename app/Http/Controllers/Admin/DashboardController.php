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
        $admin=Auth::guard('user')->user();
        $booking = DB::select(DB::raw("select count(id) as count_rs from `booking` where `user_id` =$admin->id and `status` =1 ")); 
        return view('admin.dashboard',compact('booking')); 
    }catch (Exception $e) { }
  }
    

    // public function addNewUser()
    // {
    // 	try{

    // 		$roles = DB::select(DB::raw("select * from `role_type` order by `id`")); 
    // 		return view('admin.UserManagements.add_new_user' ,compact('roles')); 
    // 	}catch (Exception $e) {
    		
    // 	}
    // }
    // public function addNewUserStore(Request $request)
    // {
    // 	try {
    // 		$rules=[
    //         'name' => 'required|string|min:2|max:50',             
    //         'email_id' => 'required|email|unique:users',
    //         "mobile_no" => 'required|unique:users|numeric|digits:10',
    //         "role_id" => 'required',
    //         "password" => 'required|min:6|max:15', 
    //         "retype_password" => 'required|min:6|max:15', 
    //     	];

	   //      $validator = Validator::make($request->all(),$rules);
	   //      if ($validator->fails()) {
	   //          $errors = $validator->errors()->all();
	   //          $response=array();
	   //          $response["status"]=0;
	   //          $response["msg"]=$errors[0];
	   //          return response()->json($response);// response as json
	   //      }
	   //      if($request->password != $request->retype_password){
    //      		$response=['status'=>0,'msg'=>'Passwords Not Match'];
	   //      	return response()->json($response);
    // 		}
	   //      $admin=Auth::guard('user')->user(); 
	   //      $en_password = bcrypt($request['password']);
	   //      DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`,`role_id`, `created_by`,`approved_by`,`status`) Values ('$request->name', '$request->email_id', '$request->mobile_no', '$en_password',$request->role_id,$admin->id,$admin->id,1);"));

	   //      $response=['status'=>1,'msg'=>'Account Created Successfully'];
	   //      return response()->json($response);   
    	 
    // 	}catch (Exception $e) {
    		
    // 	}
    // }
    // public function userList()
    // {
    //   try{
    //       $userlists = DB::select(DB::raw("select * from `users` order by `name`"));
    //       return view('admin.UserManagements.user_list',compact('userlists'));
    //       }catch (Exception $e) {
        
    //     }
    // }
    // public function changePassword()
    // {
    //    return view('admin.UserManagements.change_password');
    // }
    // public function changePasswordStore(Request $request)
    // { 
    //   $rules=[
    //   'oldpassword'=> 'required|min:6|max:15',
    //   'password'=> 'required|min:6|max:15',
    //   'passwordconfirmation'=> 'required|min:6|max:15|same:password',
    //    ];
    //   $validator = Validator::make($request->all(),$rules);
    //   if ($validator->fails()) {
    //       $errors = $validator->errors()->all();
    //       $response=array();
    //       $response["status"]=0;
    //       $response["msg"]=$errors[0];
    //       return response()->json($response);// response as json
    //   }        
    //   $user=Auth::guard('user')->user();              
    //   $user_id=$user->id;  
    //   if(password_verify($request->oldpassword,$user->password)){
    //       if ($request->oldpassword == $request->password) {
    //            $response=['status'=>0,'msg'=>'Old Password And New Password Cannot Be Same'];
    //            return response()->json($response);
    //       }else{
    //         $password=bcrypt($request['password']); 
    //         $user_rs = DB::select(DB::raw("update `users` set `password` ='$password' where `id` =$user_id limit 1")); 
    //         $response=['status'=>1,'msg'=>'Password Change Successfully'];
    //         return response()->json($response);// response as json 
    //       } 
    //   }else{               
    //       $response=['status'=>0,'msg'=>'Old Password Is Not Correct'];
    //       return response()->json($response);// response as json
    //   }        
    // }
    
    
  
    public function attendance()
    {
      return view('admin.booking.attendance');
    } 
    public function attendanceBarcode(Request $request)
    {
        
        $bookings=DB::select(DB::raw("select * from `booking` where  `id` = $request->ticket_no and `status` = 1 limit 1"));
        $checkin_details=DB::select(DB::raw("select * from `checkin_detail` where  `booking_id` = $request->ticket_no "));
        if (empty($bookings)) {
            $response=['status'=>0,'msg'=>'Invalid Ticket No.'];
            return response()->json($response);
        } 
        return view('admin.booking.attendance_form',compact('bookings','checkin_details')); 
    }
    public function attendanceStore(Request $request)
    {   
        if ($request->adults_count == 0 && $request->children_count == 0) {
        $response=['status'=>0,'msg'=>'Could Not Check in, Plz check again'];
        return response()->json($response);
        } 
       
        $admin=Auth::guard('user')->user();
        $booking_id = $request->booking_id;
        $book_ad = 0;
        $book_ch = 0;
        $booking=DB::select(DB::raw("select * from `booking` where  `id` = '$booking_id' and `status` = 1 limit 1"));
        if(count($booking)>=1){
            $book_ad =  $booking[0]->adults;
            $book_ch = $booking[0]->children;
        }
        $checkin=DB::select(DB::raw("select ifnull(sum(`adults_count`),0) as `checkin_ad`, ifnull(sum(`children_count`),0) as `checkin_ch` from `checkin_detail` where `booking_id` = '$booking_id';"));
        $checkin_ad = $checkin[0]->checkin_ad + $request->adults_count;
        $checkin_ch = $checkin[0]->checkin_ch + $request->children_count;
        if ($checkin_ad <= $book_ad && $checkin_ch <= $book_ch) {
          $bookings=DB::select(DB::raw("Insert  Into `checkin_detail` (`user_id` ,`booking_id` ,`adults_count` , `children_count`) Values ($admin->id , '$request->booking_id' , '$request->adults_count' , '$request->children_count');"));
          $response=['status'=>1,'msg'=>'Save Successfully'];
        return response()->json($response);  
        } 
        $response=['status'=>0,'msg'=>'Could Not Check in, Plz check again'];
        return response()->json($response); 
    }
    
}
