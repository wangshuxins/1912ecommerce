<?php

namespace App\Http\Controllers\Operators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function contentcategory(){
	
	
	   return view('Merchandise.Operators.contentcategory');
	
	}
	 public function content(){
	
	
	   return view('Merchandise.Operators.content');
	
	}
}
