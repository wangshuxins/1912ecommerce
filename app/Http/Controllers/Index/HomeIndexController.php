<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//商品表
use App\Model\GoodsModel;
//浏览记录表
use App\Model\HistoryModel;
//用户表
use App\Http\Controllers\Index\Common As Commons;
//订单表
use App\Model\Order_InfoModel;
//订单商品详情
use App\Model\Order_GoodsModel;
//订单地址详情
use App\Model\Order_AddressModel;
use Illuminate\Support\Facades\Cookie;
use App\Model\carModel;
class HomeIndexController extends Commons
{
    public function homeindex(){

		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$user_id = $this->sessionUserId();
        $myorder = Order_InfoModel::where('shop_order_info.user_id',$user_id)->where("is_del",1)->Join('shop_order_goods','shop_order_info.order_id','=','shop_order_goods.order_id')
				   ->get();
//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//

		if(!session()->get("users")){//没有登录时   头部导航栏的购物车

			$car=$this->buyListCookie();
			if(empty($car)){
				$car =[];
			}
		}else{//登录的情况下
			// $user_id = $this->sessionUserId();
			$user_id=session("users")['user_id'];
			$where = [
					['user_id','=',$user_id],
					['shop_cary.is_del','=',1]
			];
			$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
					->where($where)
					->orderBy('shop_cary.add_time','desc')
					->get()->toArray();
		}

		//—————————————————————————————————————————————————————————————————————————————————————//
		return view('Merchandise.Index.homeindex',['car'=>$car,'dingji'=>$dingji,"quanbu"=>$quanbu,'myorder'=>$myorder,'car'=>$car]);
	}
	public function homeorderdetail(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//

		if(!session()->get("users")){//没有登录时   头部导航栏的购物车

			$car=$this->buyListCookie();
			if(empty($car)){
				$car =[];
			}
		}else{//登录的情况下
			// $user_id = $this->sessionUserId();
			$user_id=session("users")['user_id'];
			$where = [
					['user_id','=',$user_id],
					['shop_cary.is_del','=',1]
			];
			$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
					->where($where)
					->orderBy('shop_cary.add_time','desc')
					->get()->toArray();
		}

		//—————————————————————————————————————————————————————————————————————————————————————//
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderdetail',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods,'car'=>$car]);
	 
	}
	public function homeorderevaluate(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
			//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//

			if(!session()->get("users")){//没有登录时   头部导航栏的购物车

				$car=$this->buyListCookie();
				//dd($car);
				if(empty($car)){
					$car =[];
				}

			}else{//登录的情况下
				// $user_id = $this->sessionUserId();
				$user_id=session("users")['user_id'];
				$where = [
						['user_id','=',$user_id],
						['shop_cary.is_del','=',1]
				];
				$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
						->where($where)
						->orderBy('shop_cary.add_time','desc')
						->get()->toArray();
			}

			//—————————————————————————————————————————————————————————————————————————————————————//
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderevaluate',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods,'car'=>$car]);
	 
	}
	public function homeorderpay(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//

			if(!session()->get("users")){//没有登录时   头部导航栏的购物车
				$cart = Cookie::get('cartInfo');

				$cart = unserialize($cart);
				$car=$this->buyListCookie();
				if(empty($car)){
					$car=[];
				}

				}else{//登录的情况下
				// $user_id = $this->sessionUserId();
				$user_id=session("users")['user_id'];
					$where = [
						['user_id','=',$user_id],
						['shop_cary.is_del','=',1]
				];
				$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
						->where($where)
						->orderBy('shop_cary.add_time','desc')
						->get()->toArray();

			}

		//—————————————————————————————————————————————————————————————————————————————————————//
         $user_id = $this->sessionUserId();
		 $homeorderpay = Order_InfoModel::where('shop_order_info.user_id',$user_id)->where("is_del",1)->where('order_status',1)->Join('shop_order_goods','shop_order_info.order_id','=','shop_order_goods.order_id')
				   ->get();
	   return view('Merchandise.Index.homeorderpay',['dingji'=>$dingji,"quanbu"=>$quanbu,"car"=>$car,'homeorderpay'=>$homeorderpay]);
	 
	}
	public function homeorderreceive(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		
		//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//

			if(!session()->get("users")){//没有登录时   头部导航栏的购物车
				$cart = Cookie::get('cartInfo');

				$cart = unserialize($cart);
				$car=$this->buyListCookie();
				if(empty($car)){
					$car=[];
				}

				}else{//登录的情况下
				// $user_id = $this->sessionUserId();
				$user_id=session("users")['user_id'];
					$where = [
						['user_id','=',$user_id],
						['shop_cary.is_del','=',1]
				];
				$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
						->where($where)
						->orderBy('shop_cary.add_time','desc')
						->get()->toArray();

			}

		//—————————————————————————————————————————————————————————————————————————————————————//
		$homeorderreceive = Order_InfoModel::where('shop_order_info.user_id',$user_id)->where("is_del",1)->where('order_status',3)->Join('shop_order_goods','shop_order_info.order_id','=','shop_order_goods.order_id')
				->get();
	   return view('Merchandise.Index.homeorderreceive',['dingji'=>$dingji,"quanbu"=>$quanbu,'car'=>$car,'homeorderreceive'=>$homeorderreceive]);
	 
	}
	public function homeordersend(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		
		//—————————————————————————————————  —购—物—车—  ——————————————————————————————————————//
			if(!session()->get("users")){//没有登录时   头部导航栏的购物车
				$cart = Cookie::get('cartInfo');

				$cart = unserialize($cart);
				$car=$this->buyListCookie();
				if(empty($car)){
					$car=[];
				}

				}else{//登录的情况下
				// $user_id = $this->sessionUserId();
				$user_id=session("users")['user_id'];
					$where = [
						['user_id','=',$user_id],
						['shop_cary.is_del','=',1]
				];
				$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
						->where($where)
						->orderBy('shop_cary.add_time','desc')
						->get()->toArray();

			}
		//—————————————————————————————————————————————————————————————————————————————————————//
		 $user_id = $this->sessionUserId();
		 $homeordersend = Order_InfoModel::where('shop_order_info.user_id',$user_id)->where("is_del",1)->where('order_status',2)->Join('shop_order_goods','shop_order_info.order_id','=','shop_order_goods.order_id')
				   ->get();
		foreach($homeordersend as $v){
			if(time()-$v['add_time']>60*5000000){
				 Order_InfoModel::where('order_id',$v['order_id'])->where('user_id',$v['user_id'])->update(['order_status'=>3]);
			}
		}

	  return view('Merchandise.Index.homeordersends',['dingji'=>$dingji,"quanbu"=>$quanbu,'car'=>$car,'homeordersend'=>$homeordersend]);
	 
	}
	public function buyListCookie(){

		$cartInfos = Cookie::get('cartInfo');
		$car = unserialize($cartInfos);
		if(!empty($car)){
			//数据倒顺序
			$add_time = array_column($car,'add_time');

			array_multisort($add_time,SORT_DESC,$car);

			//print_r($cartInfo);exit;

			foreach($car as $k=>$v){

				$where = [
						['goods_id','=',$v['goods_id']]
				];

				$arr = GoodsModel::where($where)->first()->toArray();

				//print_r($goods);

				$car[$k] = array_merge($v,$arr);

			}
			return $car;
		}
	}
	

}
