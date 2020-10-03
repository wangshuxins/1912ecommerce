<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay(){
	
	  return view("Merchandise.Index.pay");

	}
	public function payfail(){
	
	   return view("Merchandise.Index.payfail");
	}

	public function paysuccess(){
	
	   return view("Merchandise.Index.paysuccess");
	}
}
