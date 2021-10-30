<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Validator;  

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
	        $admin=Auth::guard('admin')->user(); 
	        $user_id =1;
	        $en_password = bcrypt($request['password']);
	        DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`,`role_id`, `created_by`,`status`) Values ('$request->name', '$request->email_id', '$request->mobile_no', '$en_password',$request->role_id, 1,0);"));

	        $response=['status'=>1,'msg'=>'Account Created Successfully'];
	        return response()->json($response);   
    	 
    	}catch (Exception $e) {
    		
    	}
    }
    public function booking()
    {
      try{ 
            return view('admin.UserManagements.booking'); 
        }catch (Exception $e) {
        
        }
    }
    
}
