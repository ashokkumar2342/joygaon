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
    public function bookingStore(Request $request)
    {
        try {
            $rules=[
            'booking_type' => 'required',             
            'booking_date' => 'required',             
            'adults' => 'required',             
            'children' => 'required',
            "senior_citizens" => 'required',
            "head_name" => 'required',
            "team_leader_name" => 'required', 
            "head_mobile_no" => 'required', 
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $response=array();
                $response["status"]=0;
                $response["msg"]=$errors[0];
                return response()->json($response);// response as json
            }
            $admin=Auth::guard('user')->user(); 
            DB::select(DB::raw("Insert Into `booking` (`user_id`,`booking_type_id`, `booking_date`, `adults`, `children`,`senior_citizens`, `head_name`,`team_leader_name`,`head_mobile_no`,`head_email_id`) Values ($admin->id,'$request->booking_type', '$request->booking_date', '$request->adults', '$request->children',$request->senior_citizens,'$request->head_name','$request->team_leader_name','$request->head_mobile_no','$request->head_email_id');"));
            $path=Storage_path('fonts/');
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir']; 
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata']; 
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [55, 35],
                 'fontDir' => array_merge($fontDirs, [
                     __DIR__ . $path,
                 ]),
                 'fontdata' => $fontData + [
                     'frutiger' => [
                         'R' => 'FreeSans.ttf',
                         'I' => 'FreeSansOblique.ttf',
                     ]
                 ],
                 'default_font' => 'freesans'
             ]);
            $dirpath = Storage_path() . '/app/qrcode/1';
            $vpath = 'app/qrcode/1';
            @mkdir($dirpath, 0755, true);; 
            $mpdf->WriteHTML('admin.booking.barcode');
            $mpdf->Output($vpath.'/filename.pdf', 'F'); 
            return redirect()->route('admin.payment')->with(['message'=>'Booking Successfully','class'=>'success']); 
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
    public function paymentOptionStore(Request $request)
    { 
      if ($request->payment_mode!=1) {
           $rules=[  
            "payment_mode" => 'required', 
            "account_name" => 'required', 
            "qr_code" => 'required', 
          ];  
      }else{
          $rules=[  
          "payment_mode" => 'required', 
          "account_no" => 'required', 
          "ifsc_code" => 'required', 
          "account_name" => 'required', 
          "bank_name" => 'required', 
          "branch_name" => 'required', 
        ];
      }  
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          $errors = $validator->errors()->all();
          $response=array();
          $response["status"]=0;
          $response["msg"]=$errors[0];
          return response()->json($response);// response as json
      }
       $user=Auth::guard('user')->user();
       $PaymentOption=DB::select(DB::raw("Insert Into `payment_option` (`user_id`, `payment_mode_id`, `account_no`, `ifsc_code`,`account_name`, `bank_name`,`branch_name`,`status`) Values ('$user->id', '$request->payment_mode', '$request->account_no', '$request->ifsc_code','$request->account_name','$request->bank_name','$request->branch_name',0);"));
       $PaymentOption=DB::select(DB::raw("SELECT `id` FROM payment_option ORDER BY `id` DESC LIMIT 1"));  
       //--start-image-save
       if ($request->payment_mode!=1) { 
            $dirpath = Storage_path() . '/app/qrcode/'.$PaymentOption[0]->id;
            $vpath = '/qrcode/'.$PaymentOption[0]->id;
            @mkdir($dirpath, 0755, true);
            $file =$request->qr_code;
            $imagedata = file_get_contents($file);
            $encode = base64_encode($imagedata);
            $image=base64_decode($encode);
            $id=$PaymentOption[0]->id; 
            $image= \Storage::disk('local')->put($vpath.'/'.$id.'.jpg',$image);
            $fullpath=$vpath.'/'.$id.'.jpg';
            $update_rs = DB::select(DB::raw("update `payment_option` set `qr_code` ='$fullpath' where `id` = $id limit 1;")); 
       }
        //--end-image-save 
       $response=['status'=>1,'msg'=>'Submit Successfully'];
            return response()->json($response);
    }
    public function paymentOptionStatus($id)
    {
      $PaymentOptions = DB::select(DB::raw("select `id`,`status` from `payment_option` where `id` = $id limit 1;"));
      if ($PaymentOptions[0]->status==1) {
          $PaymentOptions = DB::select(DB::raw("update `payment_option` set `status` =0 where `id` = $id limit 1;"));
       }
      elseif ($PaymentOptions[0]->status==0) {
          $PaymentOptions = DB::select(DB::raw("update `payment_option` set `status` =1 where `id` = $id limit 1;"));
       } 
       return redirect()->back()->with(['message'=>'Successfully','class'=>'success']); 
    }
    public function payment()
    {
        $paymentModes = DB::select(DB::raw("select * from `payment_mode` order by `id`"));
        return view('admin.booking.payment',compact('paymentModes'));
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
    
}
