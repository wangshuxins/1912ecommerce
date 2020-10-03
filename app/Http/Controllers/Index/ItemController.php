<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//cookie门面
use Illuminate\Support\Facades\Cookie;
//商品表
use App\Model\GoodsModel;
//浏览记录表
use App\Model\HistoryModel;
//用户表
use App\Model\UserModel;
use App\Model\CarModel;
//Common
use App\Http\Controllers\Index\Common As Commons;

class ItemController extends Commons
{
	//浏览记录
    public function item(){

    	if(request()->isMethod('get')){
    	//商品的分类
    	$dingji=$this->daohanglan();
    	$quanbu=$this->cateinfo();
			//接过来的商品id
    	$id=request()->id;
    	//dd($id);
    	$goods=	GoodsModel::where("goods_id",$id)->get();
    		//dd($goods);
			//判断
			if($this->checkLogin()){

				$this->saveHistoryDb($id);

			}else{

				$this->saveHistoryCookie($id);
			}

       return view("Merchandise.Index.item",['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
		}
		if(request()->isMethod("post")){
			$goods_price=request()->goods_price;
			$goods_sum=request()->goods_sum;
			     $goods_price=($goods_price*$goods_sum);
			     return $goods_price;
		}
	}
	public function saveHistoryDb($id){

			$user_id = $this->sessionUserId();

		    $arr = ['goods_id'=>$id,'add_time'=>time(),'user_id'=>$user_id];

		    $history = new HistoryModel();

		    $history->insert($arr);

	}
	public function saveHistoryCookie($id){

		$historyInfos = Cookie::get('historyInfo');

		$merge = unserialize($historyInfos);

		$merge[] = [
				'goods_id'=>$id,'add_time'=>time()
		];

		Cookie::queue('historyInfo',serialize($merge));

	}

}
