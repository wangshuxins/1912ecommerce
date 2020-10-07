<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\CategoryModel;
use App\Model\SlideModel;
use App\Model\AdModel;
use Illuminate\Support\Facades\cookie;
use App\Model\carModel;
class IndexController extends Controller
{
	public function index(){
		if(request()->ajax()){
			$cate_id=request()->cate_id;
			$res=CategoryModel::select("cate_id")->where("parent_id",$cate_id)->get()->toArray();
			//dd($res);
			$arr=[];
			foreach($res as $k=>$v){
				foreach($v as $l=>$a){
					$arr[]=$a;
				}
			}
			$res=GoodsModel::OrderBy("goods_id","desc")->select("goods_img","goods_id")->whereIn("cate_id",$arr)->where("is_del",1)->limit("10")->get();//->toArray();
			//	return $res;
			//dd($res);//'dingji'=>$dingji,'manContent'=>$manContent,'quanbu'=>$quanbu,
			return view("Merchandise.Index.indexajax",['res'=>$res]);
		}
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
		$quanbu=$this->cateinfo();//数组
		$manContent=[];//因为下标从零开始循环，所有数组数量-1，循环分配到manContent中 count统计数组个数
		for($i=0;$i<=count($quanbu)-1 ;$i++){
			$manContent[$i]=$quanbu[$i];
		}
		$dingji=$this->daohanglan();//导航栏顶级类型
		$luenbutu=SlideModel::get();//轮播图
		$guanggao=AdModel::OrderBy("ad_id","desc")->limit(5)->get();//广告
		return view("Merchandise.Index.index",['car'=>$car,'dingji'=>$dingji,'manContent'=>$manContent,'quanbu'=>$quanbu,'luenbutu'=>$luenbutu,"guanggao"=>$guanggao]);


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