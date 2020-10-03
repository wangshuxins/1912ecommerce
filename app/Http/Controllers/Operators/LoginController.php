<?php

namespace App\Http\Controllers\Operators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
	
	   return view('Merchandise.Operators.login');
	
	}
}
