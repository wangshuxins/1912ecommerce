<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
class CarController extends Controller
{
    public function car(){
		return view("Merchandise.Index.car");
	}
}
