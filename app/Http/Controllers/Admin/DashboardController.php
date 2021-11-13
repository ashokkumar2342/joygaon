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
	        DB::select(DB::raw("Insert Into `users` (`name`, `email_id`, `mobile_no`, `password`,`role_id`, `created_by`,`approved_by`,`status`) Values ('$request->name', '$request->email_id', '$request->mobile_no', '$en_password',$request->role_id,$admin->id,$admin->id,1);"));

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
          // dd($bookingTypes);
          $t1_ad_amount=$bookingTypes[0]->ad_amount;
          $t2_ad_amount=$bookingTypes[1]->ad_amount;
          $t3_ad_amount=$bookingTypes[2]->ad_amount;
          $t1_ch_amount=$bookingTypes[0]->ch_amount;
          $t2_ch_amount=$bookingTypes[1]->ch_amount;
          $t3_ch_amount=$bookingTypes[2]->ch_amount;
          return view('admin.booking.booking',compact('bookingTypes','t1_ad_amount','t2_ad_amount','t3_ad_amount','t1_ch_amount','t2_ch_amount','t3_ch_amount')); 
        }catch (Exception $e) {
        
        }
    }  
    public function paymentStatus()
    {
      $user=Auth::guard('user')->user(); 
      $paymentStatus = DB::select(DB::raw("select `op`.`order_id`,`op`.`booking_id`,`op`.`amount`,`op`.`status`,`book`.`adults`,`book`.`children`,`book`.`booking_date` from `online_payments` `op` inner join `booking` `book` on `book`.`user_id`=$user->id ")); 
      return view('admin.booking.payment',compact('paymentStatus'));
    }
    
    
    public function printTicket()
    {
        $path=Storage_path('fonts/');
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir']; 
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata']; 
         
            $card_width =90;
            $card_height =55;
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [$card_width, $card_height],
             'fontDir' => array_merge($fontDirs, [
                 __DIR__ . $path,
             ]),
             'fontdata' => $fontData + [
                 'frutiger' => [
                     'R' => 'FreeSans.ttf',
                     'I' => 'FreeSansOblique.ttf',
                 ]
             ],
             'default_font' => 'freesans',
             'pagenumPrefix' => '',
            'pagenumSuffix' => '',
            'nbpgPrefix' => ' कुल ',
            'nbpgSuffix' => ' पृष्ठों का पृष्ठ'
         ]); 
         $html = view('admin.booking.ticket_pdf'); 
         $mpdf->WriteHTML($html); 
         $documentUrl = Storage_path() . '/app/ticket/10001';   
        @mkdir($documentUrl, 0755, true);  
        $mpdf->Output($documentUrl.'.pdf', 'F');
        // return view('admin.booking.print_ticket',compact('paymentModes'));
    }
    public function attendance()
    {
      return view('admin.booking.attendance',compact('paymentModes'));
    }
    public function attendanceBarcode(Request $request)
    {
      $attendance=DB::select(DB::raw("select * from `payment_mode` order by `id`")); 
    }
    
}
