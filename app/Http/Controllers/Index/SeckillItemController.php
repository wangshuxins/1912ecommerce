<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeckillItemController extends Controller
{
    public function seckillitem(){
	
	  return view("Merchandise.Index.seckillitem");
	}
}
