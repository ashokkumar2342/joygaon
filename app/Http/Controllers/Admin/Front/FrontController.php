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
 
}
