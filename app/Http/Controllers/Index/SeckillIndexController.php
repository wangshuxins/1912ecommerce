<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeckillIndexController extends Controller
{
    public function seckillindex(){
	

	  return view("Merchandise.Index.seckillindex");
	}
}
