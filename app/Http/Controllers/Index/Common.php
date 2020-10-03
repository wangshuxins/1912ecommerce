<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
class Common extends Controller
{
    public function checkLogin(){
        return session("users");
    }
    public function sessionUserId(){

        return session('users')['user_id'];

    }
    public function checkGoodsNum($goods_num,$goods_id,$already_num=0){


        $shop_goods = new GoodsModel();

        $goods_number = $shop_goods::where('goods_id','=',$goods_id)->value("goods_store");

        if(($goods_num+$already_num)>$goods_number){

            return false;

        }else{
            return true;

        }
    }
}
