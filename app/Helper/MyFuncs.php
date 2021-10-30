<?php

namespace App\Helper;


use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Facades\DB;

class MyFuncs {

   
  public static function userHasMinu(){ 
    $user_rs=Auth::guard('user')->user();  
    $user_role = $user_rs->role_id;
    return $menuTypes = DB::select(DB::raw("select * from `menu_type` where `id` in (select Distinct `sm`.`menu_type_id` from `menu_permission` `drm` inner join `sub_menu` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where `drm`.`role_id` = $user_role and `drm`.`status` = 1) order by `order_by` ;"));
  }
  public static function mainMenu($menu_type_id){ 
    $user_rs=Auth::guard('user')->user();  
    $user_role = $user_rs->role_id;

    return $subMenus = DB::select(DB::raw("select `sm`.`id`, `sm`.`name`, `sm`.`status`, `sm`.`link` from `menu_permission` `drm` inner join `sub_menu` `sm` on `sm`.`id` = `drm`.`sub_menu_id` where `drm`.`role_id` = $user_role and `drm`.`status` = 1 and `sm`.`menu_type_id` = $menu_type_id order by `sm`.`order_by` ;"));
  }
  public static function isPermission(){ 
    $user =Auth::guard('user')->user();
    $routeName= Route::currentRouteName();
    return true;
  }

    
  
    
}

