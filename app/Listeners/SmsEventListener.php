<?php

namespace App\Listeners;

use App\Admin;
use App\Admin\Model\SmsApi;
use App\Events\SmsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SmsEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SmsEvent  $event
     * @return void
     */
  public function handle(SmsEvent $event)
  {   Log::info('message sent');

        $url = "http://smsdealnow.com/api/pushsms?user=eageskool&authkey=92OnWW5BqI2&sender=EXCNET&mobile=7903436369&text=Dear kumar, You have successfully registered for an account with your userid : kumar, password : pass. EXCELNET&entityid=1701161891809058634&templateid=1707162253528439997&rpt=1";
        // $response = file_get_contents($url);

        // $url = "http://smsdealnow.com/api/pushsms?user=eageskool&authkey=  92OnWW5BqI2&sender=EXCNET&mobile=7903436369&text=Dear kumar, You have successfully registered for an account with your userid : kumar, password : pass. EXCELNET&entityid=  1701161891809058634&templateid=1707162253528439997&rpt=1";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch); 
         \Log::info($url); 
        //     return $response; 
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $curl_scraped_page = curl_exec($ch);
        // curl_close($ch); 


         // $msg=urlencode($event->message);
         
         // $url = "$smsApi->url?user=$smsApi->user_id&pwd=$smsApi->password&senderid=$smsApi->sender_id&mobileno=$admin->mobile&msgtext=$msg";
         // $ch = curl_init($url);
         // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         // $curl_scraped_page = curl_exec($ch);
         // curl_close($ch); 
          Log::info($url); 
  }
}
