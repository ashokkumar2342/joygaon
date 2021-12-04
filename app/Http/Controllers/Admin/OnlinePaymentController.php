<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\OnlinePayment; 
use Auth;
use App\Events\SmsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OnlinePaymentController extends Controller
{
    //  public function index()
    //  {
    //      $student_id =1;
    //      $orders = OnlinePayment::where('student_id',$student_id)->get();
    //      return view('admin.online_payment.payment',compact('orders'));
    //  }

    //  /**
    //   * Show the form for creating a new resource.
    //   *
    //   * @return \Illuminate\Http\Response
    //   */
    //  public function create()
    //  {
    //      //
    //  }

    //  /**
    //   * Store a newly created resource in storage.
    //   *
    //   * @param  \Illuminate\Http\Request  $request
    //   * @return \Illuminate\Http\Response
    //   */
    
    public function paytmCallback( Request $request ) { 
        $order_id = $request['ORDERID'];  
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
            $this->printTicket($order_id);
            $downloadTicket = DB::select(DB::raw("select *  from `booking` where `order_id` = '$order_id'  limit 1;"));
            //--end-pdf-generate
            //--start-sms
            $message = $downloadTicket[0]->id.' is the Verification code for registration on joygaon. EXCELNET';
            $tempid ='1707163663440740652'; 
            event(new SmsEvent($request->mobile_no,$message,$tempid));
            //--end-sms
            //--start-email 
            
            $booking_date=$downloadTicket[0]->booking_date;
            $order_id=$downloadTicket[0]->order_id;
            $email_id=$downloadTicket[0]->email_id;
            $user_name=$downloadTicket[0]->person_name;
            $ticket_no=$downloadTicket[0]->id;
            $downloadTicket = reset($downloadTicket);
            $documentUrl = Storage_path().'/app/ticket/'.$booking_date.'/'.$order_id; 
            $files =$documentUrl.'.pdf';
            $data["email"] = $email_id;
            $data["user_name"] = $user_name;
            $data["ticket_no"] = $ticket_no;
            $data["subject"] = "Joygaon Ticket Booking";
            \Mail::send('emails.attachment', $data, function($message)use($data, $files) {
            $message->to($data["email"])->subject($data["subject"]); 
            $message->attach($files); 
            });
             //--end-email 
            return redirect()->route('admin.booking.status')->with(['message'=>'Payment Successfully','class'=>'success']);
            return view('admin.online_payment.order-complete',compact('order'));
        } else if( 'TXN_FAILURE' === $request['STATUS'] ){
            return redirect()->route('admin.booking.status')->with(['message'=>'Payment Failed','class'=>'error']);
        }else if( 'PENDING' === $request['STATUS'] ){
            return redirect()->route('admin.booking.status')->with(['message'=>'Payment Pending','class'=>'error']);
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
        $paramList["CALLBACK_URL"] = url( '/online-pay/paytm-callback' );
        $paytm_merchant_key = env('PAYTM_MERCHANT_KEY');
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
        return array(
            'checkSum' => $checkSum,
            'paramList' => $paramList
        );
    }
    

    public function payAgain($booking_id)
    {   
        $booking_id=Crypt::decrypt($booking_id);
        $admin=Auth::guard('user')->user();
        $booking=DB::select(DB::raw("SELECT `amount` , `order_id` FROM `booking` where `id`=$booking_id LIMIT 1"));
        $old_order_id=$booking[0]->order_id;
        
        // $order = new OnlinePayment(); 

        $new_order_id = uniqid();
        DB::select(DB::raw("UPDATE `booking` SET `order_id` = '$new_order_id' where `id`=$booking_id LIMIT 1"));
        DB::select(DB::raw("UPDATE `online_payments` SET `order_id` = '$new_order_id' where `booking_id`=$booking_id LIMIT 1"));

        // $order->user_id =$admin->id;
        // $order->order_id =$order_id;
        // $order->booking_id =$booking_id;
        // $order->amount =$amount[0]->amount;
        // $order->status =0; 
        // $order->save();
        // $order_id=$booking[0]->order_id;
        $amount=$booking[0]->amount;
        $data_for_request = $this->handlePaytmRequest( $new_order_id, $amount);
        $paytm_txn_url = env('PAYTM_TXN_URL');
        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view( 'admin.online_payment.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );


        
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
    

    // public function completed(Request $request,$id) {
    //     $admin=Auth::guard('user')->user();
    //  	$order = OnlinePayment::where('id', Crypt::decrypt($id))->first();
    //     $order_id = $order->order_id;
    //     $this->printTicket($order_id);
    //     // event(new SmsEvent($admin[0]->mobile_no,'Booking Successfully'));
    //     // $data = array( 'email' => $request->email_id, 'otp' =>  $email_otp, 'from' => 'info@joygaon.in', 'from_name' => 'Joygaon' );
    //     // Mail::send('emails.mail_otp', $data, function( $message ) use ($data)
    //     // {
    //     // $message->to( $data['email'] )->from( $data['from'], 'Joygaon' )->subject( 'Code Verification!' );
    //     // });
    //     return redirect()->route('admin.booking.status')->with(['message'=>'Payment Successfully','class'=>'success']);
          
    // }


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
        $bimage1  =\Storage_path('app/image/front_1.jpg');
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



    // public function paymentFailed(Request $request) {     	 
    //     return redirect()->route('admin.booking.status')->with(['message'=>'Payment Failed','class'=>'error']);
    // }


    
}
