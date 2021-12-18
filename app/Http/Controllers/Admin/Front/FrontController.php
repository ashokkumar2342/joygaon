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
use App\Model\OnlinePayment;
use App\Events\SmsEvent;
class FrontController extends Controller
{
   
	public function index()
	{     
		try{ 
			return view('front.index'); 
		}catch (Exception $e) { }
	}
	public function booknowF($value='')
	{
		try{ 
			return view('front.add_page'); 
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
    public function codeResend($mobile_no)
    {
        $mobile_no = Crypt::decrypt($mobile_no);
        $rs_otp = random_int(100000, 999999);
        $guest = DB::select(DB::raw("delete from `guest_users` where `mobile_no` ='$mobile_no' LIMIT 1;"));
        $guest_users = DB::select(DB::raw("INSERT Into `guest_users` (`mobile_no`,`otp`) Values ('$mobile_no','$rs_otp');")); 
        $message = $rs_otp.' is the OPT Verification code for Joygaon. SIR SALASAR BALAJI ENTERPRISES PRIVATE LIMITED';
        $tempid ='1707163860074623221';
        event(new SmsEvent($mobile_no,$message,$tempid)); 
        return redirect()->back()->with(['message'=>'Code Resent Successfully.','class'=>'success']);
    }
    public function biventsBooking()
    {   
        
        $biventsBookingTypes = DB::select(DB::raw("select * from `bivents_booking_type` where `status`=1 order by `id`"));
        return view('front.bivents_booking',compact('biventsBookingTypes','mobile_no'));
    }
	public function mobileForm()
	{
        
		return view('front.mobile_form');
	}
	public function mobileVerify(Request $request)
	{
       

    	$this->validate($request, [
       
        'mobile_no' => 'required',
        'captcha' => 'required|captcha',
                  
        ]);
	  $mobile_no=$request->mobile_no;
      $rs_otp = random_int(100000, 999999);
	  $guest = DB::select(DB::raw("delete from `guest_users` where `mobile_no` ='$mobile_no' LIMIT 1;"));
	  $guest_users = DB::select(DB::raw("INSERT Into `guest_users` (`mobile_no`,`otp`) Values ('$mobile_no','$rs_otp');"));
	  $message = $rs_otp.' is the OPT Verification code for Joygaon. SIR SALASAR BALAJI ENTERPRISES PRIVATE LIMITED';
	  $tempid ='1707163860074623221';
	  event(new SmsEvent($mobile_no,$message,$tempid)); 
	  return redirect()->route('front.mobile.verify.form',Crypt::encrypt($mobile_no))->with(['class'=>'success','message'=>'Code Send Successfully']);
        
	}
	public function mobileVerifyForm($mobile_no)
	{
        
		$mobile_no = Crypt::decrypt($mobile_no);
		return view('front.mobile_verify' ,compact('mobile_no'));
	}
	public function mobileVerifystore(Request $request)
	{ 	
        
     $this->validate($request, [
   
    'code' => 'required',
    'captcha' => 'required|captcha',
              
    ]);
    $check_otp = DB::select(DB::raw("select * from `guest_users` where `mobile_no` ='$request->mobile_no' LIMIT 1;")); 
    if ($check_otp[0]->otp==$request->code) {
        return redirect()->route('front.booking.form',Crypt::encrypt($request->mobile_no))->with(['class'=>'success','message'=>'Code Verified Successfully']);
    } 
     return redirect()->back()->with(['class'=>'error','message'=>'Invalid Code']);
        
	}
	public function bookingForm($mobile_no)
	{	
		$mobile_no = Crypt::decrypt($mobile_no);
		$users=Auth::guard('user')->user();  
        $bookingTypes = DB::select(DB::raw("select * from `booking_type_all` where `status`=1 order by `id`"));
		return view('front.booking',compact('bookingTypes','mobile_no'));
	}
	public function bookingstore(Request $request)
    { 
        if (empty($request->type)) {
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

        }
        if (!empty($request->type)) {
            $this->validate($request, [
                'booking_type' => 'required', 
                "contact_person_name" => 'required', 
                "contact_mobile_no" => 'required|numeric|digits:10',  
                "email_id" => 'required',  
            ]);
         
        }
        $booking_date=date('Y-m-d');
        $user_id=0;
        if (empty($request->type)) { 
            $booking_type=DB::select(DB::raw("SELECT `ad_amount`,`ch_amount` FROM `booking_type_all` where `id`=$request->booking_type LIMIT 1"));
            $ad_amount=$booking_type[0]->ad_amount;
            $ch_amount=$booking_type[0]->ch_amount;
            $ticket_rate_adult=$ad_amount*$request->adults;
            $ticket_rate_child=$ch_amount*$request->children;
            $total_amount=($ad_amount*$request->adults)+($ch_amount*$request->children); 
            
            $company_name = MyFuncs::removeSpacialChr($request->school_Company_name);
            $address_city = MyFuncs::removeSpacialChr($request->school_Company_city);
            $contact_name = MyFuncs::removeSpacialChr($request->contact_person_name);

            $order_id = uniqid();
            
            DB::select(DB::raw("INSERT Into `booking` (`user_id`, `booking_type_id`, `booking_date`, `trip_date`, `school_Company_name`, `school_Company_city`, `adults`, `children`, `person_name`, `mobile_no`, `email_id`, `ticket_rate_adult`, `ticket_rate_child`, `amount`, `status`, `remarks`, `order_id`,`url_type`) Values ($user_id, '$request->booking_type', '$booking_date', '$request->trip_date', '$company_name', '$address_city', '$request->adults', '$request->children','$contact_name','$request->contact_mobile_no','$request->email_id','$ad_amount','$ch_amount','$total_amount', 0, '', '$order_id',2);"));

        }
        if (!empty($request->type)) { 
            $booking_type=DB::select(DB::raw("SELECT * FROM `bivents_booking_type` where `id` =$request->booking_type LIMIT 1"));
            
            $ad_amount=0;
            $ch_amount=0;
            $ticket_rate_adult=$booking_type[0]->package_price;
            $ticket_rate_child=$booking_type[0]->package_price;
            $total_amount=$booking_type[0]->package_price; 
            $contact_name = MyFuncs::removeSpacialChr($request->contact_person_name);

            $order_id = uniqid();
            
            DB::select(DB::raw("INSERT Into `booking` (`user_id`, `booking_type_id`, `booking_date`, `trip_date`,`adults`, `children`, `person_name`, `mobile_no`, `email_id`, `ticket_rate_adult`, `ticket_rate_child`, `amount`, `status`, `remarks`, `order_id` ,`url_type`) Values ($user_id, '$request->booking_type', '$booking_date', '2021-12-31','0', '0','$contact_name','$request->contact_mobile_no','$request->email_id','$ad_amount','$ch_amount','$total_amount', 0, 'Bivents', '$order_id',1);"));

        }
        $booking_id=DB::select(DB::raw("SELECT `id` FROM `booking` where `user_id` = $user_id and `order_id` = '$order_id' ORDER BY `id` DESC LIMIT 1")); 
        
        $booking_id = $booking_id[0]->id;
        $order = new OnlinePayment(); 
        $order->user_id = $user_id;
        $order->order_id = $order_id;
        $order->booking_id = $booking_id;
        $order->amount = $total_amount;
        $order->status = 0; 
        $order->save(); 
        $data_for_request = $this->handlePaytmRequest( $order_id, $total_amount );
        $paytm_txn_url = env('PAYTM_TXN_URL');
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view( 'front.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }
    public function paytmCallback( Request $request ) {  
    	
        $order_id = $request['ORDERID'];
        $transaction_id=$request['TXNDATE'];  
        if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
            $transaction_id = $request['TXNID'];
            $TXNDATE=$request['TXNDATE'];
            $order = OnlinePayment::where('order_id', $order_id)->first();
            $order->status = 1;
            $order->transaction_id = $transaction_id;
            $order->mid = $request['MID'];
            $order->paymentmode = $request['PAYMENTMODE'];
            $order->banktxtid = $request['BANKTXNID'];
            $order->bankname = $request['BANKNAME'];
            $order->txndate = $request['TXNDATE']; 
            $order->save();
            $result_rs = DB::select(DB::raw("update `booking` set `status` = '1' , `transation_no` ='$transaction_id' , `transation_date` ='$TXNDATE' where `order_id` ='$order_id' limit 1;"));
            //--start--pdf-generate
            $downloadTicket = DB::select(DB::raw("select *  from `booking` where `order_id` = '$order_id'  limit 1;"));
            if ($downloadTicket[0]->url_type==1) {
              $this->printTicketBivents($order_id);  
            }
            if ($downloadTicket[0]->url_type==2) {
              $this->printTicket($order_id);  
            }
            
            //--end-pdf-generate
            
            //--start-email 
            
            $booking_date=$downloadTicket[0]->booking_date;
            $order_id=$downloadTicket[0]->order_id;
            $email_id=$downloadTicket[0]->email_id;
            $mobile_no=$downloadTicket[0]->mobile_no;
            $user_name=$downloadTicket[0]->person_name;
            $ticket_no=$downloadTicket[0]->id;
            $downloadTicket = reset($downloadTicket);
            $documentUrl = Storage_path().'/app/ticket/'.$booking_date.'/'.$order_id; 
            $files =$documentUrl.'.pdf';
            $data["email"] = $email_id;
            $data["user_name"] = $user_name;
            $data["ticket_no"] = $ticket_no;
            $data["subject"] = "Joygaon Ticket Booking";
            $data["from"] = "info@joygaon.in";
            \Mail::send('emails.attachment', $data, function($message)use($data, $files) {
            $message->to($data["email"])->from( $data['from'], 'Joygaon' )->subject($data["subject"]); 
            $message->attach($files); 
            });
             //--end-email
            //--start-sms
            $message = 'Dear '.$user_name.', Thanks For Booking Trip For Joygoan Your Ticket No. '.$ticket_no.' For Date '.$booking_date.' Enjoy The Adventure Trip. Sir Salasar Balaji Enterprises Private Limited';
            $tempid ='1707163862931289760'; 
            event(new SmsEvent($mobile_no,$message,$tempid));
            //--end-sms 
            // return redirect()->route('admin.booking.status')->with(['message'=>'Payment Successfully','class'=>'success']);
            return view('front.order-complete',compact('order_id','user_name','ticket_no','transaction_id'));
        } else if( 'TXN_FAILURE' === $request['STATUS'] ){ 
            return redirect()->route('front.payment.failed')->with(['message'=>'Payment Failed','class'=>'error']);
        }else if( 'PENDING' === $request['STATUS'] ){ 
            return redirect()->route('front.payment.failed')->with(['message'=>'Payment Pending','class'=>'error']);
        }
    }
    

    public function handlePaytmRequest( $order_id, $amount ) { 
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();
        $checkSum = "";
        $paramList = array();
        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = env('PAYTM_MERCHANT_MID');
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = 'WEBSTAGING';
        $paramList["CALLBACK_URL"] = url( '/front-pay/paytm-callback' );
        $paytm_merchant_key = env('PAYTM_MERCHANT_KEY');
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
        return array(
            'checkSum' => $checkSum,
            'paramList' => $paramList
        );
    }

    function getAllEncdecFunc() {
        function encrypt_e($input, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
        function decrypt_e($crypt, $ky) {
            $key   = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
            return $data;
        }
        function pkcs5_pad_e($text, $blocksize) {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }
        function pkcs5_unpad_e($text) {
            $pad = ord($text(strlen($text) - 1));
            if ($pad > strlen($text))
                return false;
            return substr($text, 0, -1 * $pad);
        }
        function generateSalt_e($length) {
            $random = "";
            srand((double) microtime() * 1000000);
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";
            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }
            return $random;
        }
        function checkString_e($value) {
            if ($value == 'null')
                $value = '';
            return $value;
        }
        function getChecksumFromArray($arrayList, $key, $sort=1) {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getChecksumFromString($str, $key) {
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function verifychecksum_e($arrayList, $key, $checksumvalue) {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        function verifychecksum_eFromStr($str, $key, $checksumvalue) {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);
            $finalString = $str . "|" . $salt;
            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;
            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }
        function getArray2Str($arrayList) {
            $findme   = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false)
                {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function getArray2StrForVerify($arrayList) {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function redirect2PG($paramList, $key) {
            $hashString = getchecksumFromArray($paramList, $key);
            $checksum = encrypt_e($hashString, $key);
        }
        function removeCheckSumParam($arrayList) {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }
        function getTxnStatus($requestParamList) {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }
        function getTxnStatusNew($requestParamList) {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }
        function initiateTxnRefund($requestParamList) {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }
        function callAPI($apiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
        function callNewAPI($apiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList) {
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false)
                {
                    continue;
                }
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList) {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData =json_encode($requestParamList);
            $postData = 'JsonData='.urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse,true);
            return $responseParamList;
        }
    }


         /**
          * Config Paytm Settings from config_paytm.php file of paytm kit
          */
    function getConfigPaytmSettings() {
        define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
        define('PAYTM_MERCHANT_KEY', env('PAYTM_MERCHANT_KEY')); //Change this constant's value with Merchant key downloaded from portal
        define('PAYTM_MERCHANT_MID', env('PAYTM_MERCHANT_MID')); //Change this constant's value with MID (Merchant ID) received from Paytm
        define('PAYTM_MERCHANT_WEBSITE', env('PAYTM_MERCHANT_WEBSITE')); //Change this constant's value with Website name received from Paytm
        $PAYTM_STATUS_QUERY_NEW_URL=env('PAYTM_STATUS_QUERY_NEW_URL');
        $PAYTM_TXN_URL=env('PAYTM_TXN_URL');
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL=env('PAYTM_STATUS_QUERY_NEW_URL');
            $PAYTM_TXN_URL=env('PAYTM_TXN_URL');
        }
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
    }
 
 	public function paymentFailed(Request $request) {     	 
 	    return view('front.payment_failed');
 	}

 	public function printTicket($order_id)
 	{
 	    $path=Storage_path('fonts/');
 	    $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
 	    $fontDirs = $defaultConfig['fontDir']; 
 	    $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
 	    $fontData = $defaultFontConfig['fontdata'];
 	    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [150, 100],
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
 	    $bimage1  =\Storage_path('app/image/front_2.png');
 	    $date=date('Y-m-d');
 	    $order_id=$order_id;
 	    $booking_id=DB::select(DB::raw("SELECT * FROM `booking` where  `order_id` = '$order_id' and `status` = 1 LIMIT 1")); 
 	    $html = view('admin.booking.ticket_pdf',compact('bimage1','booking_id')); 
 	    $mpdf->WriteHTML($html); 
 	    $documentUrl = Storage_path() . '/app/ticket/'.$date;   
 	    @mkdir($documentUrl, 0755, true);  
 	    $mpdf->Output($documentUrl.'/'.$order_id.'.pdf', 'F');
 	    // return view('admin.booking.print_ticket',compact('paymentModes'));
 	}
    public function printTicketBivents($order_id)
    {
        $path=Storage_path('fonts/');
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir']; 
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [250, 100],
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
        $bimage1  =\Storage_path('app/image/bivents_front.png');
        $date=date('Y-m-d');
        $order_id=$order_id;
        $booking_id=DB::select(DB::raw("SELECT * FROM `booking` where  `order_id` = '$order_id' and `status` = 1 LIMIT 1")); 
        $booking_type_id=$booking_id[0]->booking_type_id; 
        $bivents_booking_type=DB::select(DB::raw("SELECT * FROM `bivents_booking_type` where  `id` = '$booking_type_id' and `status` = 1 LIMIT 1")); 
        $html = view('front.bivents_ticket_pdf',compact('bimage1','booking_id','bivents_booking_type')); 
        $mpdf->WriteHTML($html); 
        $documentUrl = Storage_path() . '/app/ticket/'.$date;   
        @mkdir($documentUrl, 0755, true);  
        $mpdf->Output($documentUrl.'/'.$order_id.'.pdf', 'F');
        // return view('admin.booking.print_ticket',compact('paymentModes'));
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
}
