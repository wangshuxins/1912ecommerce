<?php

namespace App\Http\Controllers\Operators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function sellerone(){
	
	
	   return view('Merchandise.Operators.sellerone');
	
	}
	 public function seller(){
	
	
	   return view('Merchandise.Operators.seller');
	
	}
}
