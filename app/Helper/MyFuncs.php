<?php

namespace App\Helper;


use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MyFuncs {

  public static function removeSpacialChr($strValue)
  {
    $newString = trim(str_replace('\'', '', $strValue));
    $newString = trim(str_replace('\\', '', $newString));
    return $newString;
  }


  public static function mainMenu($menu_type_id){ 
    $user_rs=Auth::guard('user')->user();  
    $user_role = $user_rs->role_id;

    return $subMenus = DB::select(DB::raw("select `sm`.`id`, `sm`.`name`, `sm`.`status`, `sm`.`link` from `menu_permission` `drm` inner join `sub_menu` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where `drm`.`role_id` = $user_role and `drm`.`status` = 1 and `sm`.`menu_type_id` = $menu_type_id order by `sm`.`order_by` ;"));
  }


  public static function userHasMinu(){ 
    $user_rs=Auth::guard('user')->user();  
    $user_role = $user_rs->role_id;
    return $menuTypes = DB::select(DB::raw("select * from `menu_type` where `id` in (select Distinct `sm`.`menu_type_id` from `menu_permission` `drm` inner join `sub_menu` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where `drm`.`role_id` = $user_role and `drm`.`status` = 1) order by `order_by` ;"));
  }

  public static function isPermission(){ 
    // $user =Auth::guard('user')->user();
    // $routeName= Route::currentRouteName();
    return true;
  }


  
  

  
  // public static function sendsms($mobile,$message,$tempateid){ 
    

     
  //    // $url = "http://smsdealnow.com/api/pushsms?user=eageskool&authkey=92OnWW5BqI2&sender=EXCNET&mobile=$mobile&text=$message EXCELNET&entityid=1701161891809058634&templateid=1707162253528439997&rpt=1";
  //    $url = "http://smsdealnow.com/api/pushsms?user=eageskool&authkey=  92OnWW5BqI2&sender=EXCNET&mobile=7903436369&text=Dear kumar, You have successfully registered for an account with your userid : kumar, password : pass. EXCELNET&entityid=  1701161891809058634&templateid=1707162253528439997&rpt=1";
     
  //    $ch = curl_init($url);
  //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //    $curl_scraped_page = curl_exec($ch);
  //    curl_close($ch); 
  //     \Log::info($url); 
  // }

    
  
    
}

