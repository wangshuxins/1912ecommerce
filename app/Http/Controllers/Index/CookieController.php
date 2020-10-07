<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class CookieController extends Controller
{
    public function cookie(){
        $cart = Cookie::get('remember');
        $cart = unserialize($cart);
        dd($cart);
    }
}
