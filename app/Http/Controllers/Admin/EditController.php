<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function seller(){
	
	
	   return view('Merchandise.Admin.seller');
	
	}

	 public function password(){
	
	
	   return view('Merchandise.Admin.password');
	
	}
}
