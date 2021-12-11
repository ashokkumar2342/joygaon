<?php

namespace App\Http\Controllers\Admin\Front;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helper\MyFuncs;
use App\Http\Controllers\Admin\OnlinePaymentController;
use App\Model\OnlinePayment;
class FrontController extends Controller
{
   
	public function index()
	{     
		try{ 
			return view('front.index'); 
		}catch (Exception $e) { }
	}
	public function about()
	{     
		try{ 
			return view('front.about'); 
		}catch (Exception $e) { }
	}
	public function gallery()
	{     
		try{ 
			return view('front.gallery'); 
		}catch (Exception $e) { }
	}
	public function cotactus()
	{     
		try{ 
			return view('front.cotactus'); 
		}catch (Exception $e) { }
	}
	public function priceList()
	{     
		try{
			$priceLists = DB::select(DB::raw("select * from `booking_type`;"));  
			return view('front.price_list',compact('priceLists')); 
		}catch (Exception $e) { }
	}
	public function bookNow($value='')
	{
		$users=Auth::guard('user')->user();  
        $bookingTypes = DB::select(DB::raw("select * from `booking_type` order by `id`"));
		return view('front.booking',compact('bookingTypes'));
	}
	public function bookingstore(Request $request)
    { 

        $this->validate($request, [
            'booking_type' => 'required',             
            'trip_date' => 'required',             
            'school_Company_name' => 'required',             
            'school_Company_city' => 'required',             
            'adults' => 'required|numeric',             
            'children' => 'required|numeric',  
            "contact_person_name" => 'required', 
            "contact_mobile_no" => 'required|numeric|digits:10',  
            "email_id" => 'required',  
        ]);
        $booking_date=date('Y-m-d');
         
        $admin=100;
        $booking_type=DB::select(DB::raw("SELECT `ad_amount`,`ch_amount` FROM `booking_type` where `id`=$request->booking_type LIMIT 1"));
        $ad_amount=$booking_type[0]->ad_amount;
        $ch_amount=$booking_type[0]->ch_amount;
        $ticket_rate_adult=$ad_amount*$request->adults;
        $ticket_rate_child=$ch_amount*$request->children;
        $total_amount=($ad_amount*$request->adults)+($ch_amount*$request->children); 
        
        $company_name = MyFuncs::removeSpacialChr($request->school_Company_name);
        $address_city = MyFuncs::removeSpacialChr($request->school_Company_city);
        $contact_name = MyFuncs::removeSpacialChr($request->contact_person_name);

        $order_id = uniqid();
        
        DB::select(DB::raw("INSERT Into `booking` (`user_id`, `booking_type_id`, `booking_date`, `trip_date`, `school_Company_name`, `school_Company_city`, `adults`, `children`, `person_name`, `mobile_no`, `email_id`, `ticket_rate_adult`, `ticket_rate_child`, `amount`, `status`, `remarks`, `order_id`) Values ($admin, '$request->booking_type', '$booking_date', '$request->trip_date', '$company_name', '$address_city', '$request->adults', '$request->children','$contact_name','$request->contact_mobile_no','$request->email_id','$ad_amount','$ch_amount','$total_amount', 0, '', '$order_id');"));

        $booking_id=DB::select(DB::raw("SELECT `id` FROM `booking` where `user_id` = $admin and `order_id` = '$order_id' ORDER BY `id` DESC LIMIT 1")); 
        $user_id =100; 
        $booking_id = $booking_id[0]->id;
        $order = new OnlinePayment(); 
        $order->user_id = $user_id;
        $order->order_id = $order_id;
        $order->booking_id = $booking_id;
        $order->amount = $total_amount;
        $order->status = 0; 
        $order->save();
        $objOnlinepaymentClass = new OnlinePaymentController();
        $data_for_request = $objOnlinepaymentClass->handlePaytmRequest( $order_id, $total_amount );
        $paytm_txn_url = env('PAYTM_TXN_URL');
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view( 'admin.online_payment.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }
 
}
