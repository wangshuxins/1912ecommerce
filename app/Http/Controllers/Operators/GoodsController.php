<?php

namespace App\Http\Controllers\Operators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
    public function goods(){

	   return view('Merchandise.Operators.goods');
	
	}

	 public function brand(){
	
	   return view('Merchandise.Operators.brand');
	
	}
	 public function specification(){
	
	   return view('Merchandise.Operators.specification');
	
	}
	 public function typetemplate(){
	
	   return view('Merchandise.Operators.typetemplate');
	
	}

	public function itemcat(){
	
	   return view('Merchandise.Operators.itemcat');
	
	}

	

	
}
