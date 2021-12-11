<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\Crypt;  
use Illuminate\Support\Facades\Response;  
use App\Model\OnlinePayment; 
use App\Http\Controllers\Admin\OnlinePaymentController;
use App\Helper\MyFuncs;

class BookingController extends Controller
{

    public function BookingStatus()
    {
        $user=Auth::guard('user')->user(); 
        $paymentStatus = DB::select(DB::raw("select `bk`.`order_id`, `bk`.`id`, `bk`.`adults`, `bk`.`children`, `bk`.`booking_date`, `bk`.`trip_date`, `bk`.`school_company_name`, `bk`.`school_company_city`, `bk`.`person_name`, `bk`.`mobile_no`, `bk`.`email_id`, `bk`.`remarks`, `op`.`status`, `bt`.`name`, `op`.`amount`, `op`.`transaction_id`, `op`.`txndate` from `booking` `bk` inner join `booking_type` `bt` on `bt`.`id` = `bk`.`booking_type_id` inner join `online_payments` `op` on `op`.`order_id` = `bk`.`order_id` where `bk`.`user_id` = $user->id order by `bk`.`id` desc;")); 
        return view('admin.booking.booking_status',compact('paymentStatus','user'));
    }
    

    public function storeBooking(Request $request)
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
        $objOnlinepaymentClass = new OnlinePaymentController(); 
        $admin=Auth::guard('user')->user();
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
        
        DB::select(DB::raw("INSERT Into `booking` (`user_id`, `booking_type_id`, `booking_date`, `trip_date`, `school_Company_name`, `school_Company_city`, `adults`, `children`, `person_name`, `mobile_no`, `email_id`, `ticket_rate_adult`, `ticket_rate_child`, `amount`, `status`, `remarks`, `order_id`) Values ($admin->id, '$request->booking_type', '$booking_date', '$request->trip_date', '$company_name', '$address_city', '$request->adults', '$request->children','$contact_name','$request->contact_mobile_no','$request->email_id','$ad_amount','$ch_amount','$total_amount', 0, '', '$order_id');"));

        $booking_id=DB::select(DB::raw("SELECT `id` FROM `booking` where `user_id` = $admin->id and `order_id` = '$order_id' ORDER BY `id` DESC LIMIT 1")); 
        $user_id =Auth::guard('user')->user(); 
        $booking_id = $booking_id[0]->id;
        $order = new OnlinePayment(); 
        $order->user_id = $user_id->id;
        $order->order_id = $order_id;
        $order->booking_id = $booking_id;
        $order->amount = $total_amount;
        $order->status = 0; 
        $order->save();
        $data_for_request = $objOnlinepaymentClass->handlePaytmRequest( $order_id, $total_amount );
        $paytm_txn_url = env('PAYTM_TXN_URL');
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view( 'admin.online_payment.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }

    public function showBookingForm()
    {
        try{
            $users=Auth::guard('user')->user();  
            $bookingTypes = DB::select(DB::raw("select * from `booking_type` order by `id`"));
            return view('admin.booking.booking',compact('bookingTypes','users')); 
        }catch (Exception $e) { }
    }
    public function downloadTicket($order_id)
    {
       
        $order_id=Crypt::decrypt($order_id);
        $downloadTicket = DB::select(DB::raw("select `booking_date` , `order_id` from `booking` where `order_id` = '$order_id'  limit 1;"));
        $booking_date=$downloadTicket[0]->booking_date;
        $order_id=$downloadTicket[0]->order_id;
        $downloadTicket = reset($downloadTicket);
        $documentUrl = Storage_path().'/app/ticket/'.$booking_date.'/'.$order_id;
        return response()->file($documentUrl.'.pdf');
    }
    public function report()
    {
        try{
            $users=Auth::guard('user')->user();  
            $bookingTypes = DB::select(DB::raw("select * from `booking_type` order by `id`"));
            return view('admin.booking.report',compact('bookingTypes','users')); 
        }catch (Exception $e) { }
    }
    public function reportPost(Request $request)
    {
        try{
            $users=Auth::guard('user')->user();  
            $bookings = DB::select(DB::raw("select * from `booking`;"));
            $response=array();
            $response["status"]=1;
            $response["data"]=view('admin.booking.report_table',compact('bookings'))->render();
            return response()->json($response); 
        }catch (Exception $e) { } 
    }
    public function paymentHistory()
    {
        try{
            return view('admin.booking.payment_history'); 
        }catch (Exception $e) { }
    }

    public function paymentHistoryShow(Request $request)
    {

        $rules=[ 
              'date_range'=> 'required', 
           ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
              $errors = $validator->errors()->all();
              $response=array();
              $response["status"]=0;
              $response["msg"]=$errors[0];
              return response()->json($response);// response as json
        }
        $user=Auth::guard('user')->user();
          
        $date_range= explode('-',$request->date_range);
        $from_date = date('Y-m-d H:i:s',strtotime($date_range[0]));
        $to_date =  date('Y-m-d H:i:s',strtotime($date_range[1]));  
        $bookings=DB::select(DB::raw(" select * from  `booking` where `booking_date` >= '$from_date' and `booking_date` < date_add('$to_date', INTERVAL 1 DAY) Order By  `booking_date` DESC ;"));  
        $response=array();
        $response["status"]=1;
        $response["data"]=view('admin.booking.payment_history_table',compact('bookings'))->render();
        return response()->json($response);
    } 
}