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
class HomeIndexController extends Commons
{
    public function homeindex(){

		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$user_id = $this->sessionUserId();
        $myorder = Order_InfoModel::where('shop_order_info.user_id',$user_id)->where("is_del",1)->Join('shop_order_goods','shop_order_info.order_id','=','shop_order_goods.order_id')
				   ->get();
		return view('Merchandise.Index.homeindex',['dingji'=>$dingji,"quanbu"=>$quanbu,'myorder'=>$myorder]);
	}
	public function homeorderdetail(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderdetail',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	 
	}
	public function homeorderevaluate(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderevaluate',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	 
	}
	public function homeorderpay(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderpay',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	 
	}
	public function homeorderreceive(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeorderreceive',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	 
	}
	public function homeordersend(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	   return view('Merchandise.Index.homeordersend',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	 
	}
}
