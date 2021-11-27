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
class FrontController extends Controller
{
   
public function index()
  {     
    try{ 
      return view('front.index'); 
    }catch (Exception $e) { }
  }
 
}
