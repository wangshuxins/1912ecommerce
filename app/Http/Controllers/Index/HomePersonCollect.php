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
//浏览历史
use Illuminate\Support\Facades\Cookie;
//收藏
use App\Model\CollectModel;
//购物车
use App\Model\CarModel;
class HomePersonCollect extends Commons
{
    public function homepersoncollect(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$user_id = $this->sessionUserId();
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

		$collect = CollectModel::leftJoin('shop_goods','shop_collect.goods_id','=','shop_goods.goods_id')->where("user_id",$user_id)->where('is_collect',2)->orderBy('shop_collect.add_time','desc')->get();
	    return view('Merchandise.Index.homepersoncollect',['dingji'=>$dingji,"quanbu"=>$quanbu,'collect'=>$collect,'car'=>$car]);
	}
	public function homepersonfootmark(){
		$dingji=$this->daohanglan();

		if($this->checkLogin()){

			$historyInfo = $this->TableDb();
		}else{

			$historyInfo = $this->TableCookie();
		}

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

		return view('Merchandise.Index.homepersonfootmark',['dingji'=>$dingji,'goods'=>$historyInfo,'car'=>$car]);
	}
    public function TableDb(){

		$user_id = $this->sessionUserId();
		$where = [
				['user_id','=',$user_id]
		];
		$goods_ids = HistoryModel::select('goods_id')->where($where)->orderBy('h_id','desc')->get()->toArray();
		$goods_id = [];
		foreach($goods_ids as $k=>$v){
			$goods_id[$v["goods_id"]]=$v;
		}
		if(!empty($goods_id)){
			//dump($goods_id);exit;
			$historyInfo = GoodsModel::orderBy('goods_id','desc')->whereIn('goods_id',$goods_id)->limit(8)->get()->toArray();
			//dump(db::getLastSql());exit;
			return $historyInfo;
		}else{
			return false;
		}
	}
	public function TableCookie(){

		$historyInfo = Cookie::get('historyInfo');

		$historyInfo = unserialize($historyInfo);

		if(!empty($historyInfo)){

			$goods_id = array_column($historyInfo,'goods_id');
			//print_r($goods_id);exit;
			$goods_id = array_unique($goods_id);
			// print_r($goods_id);exit;
			$goods_id = array_slice($goods_id,0,8);
			//dump($goods_id);exit;
			$historyInfo = GoodsModel::whereIn('goods_id',$goods_id)->limit(8)->get()->toArray();
			$historyInfo = array_reverse($historyInfo);
			return $historyInfo;
		}else{
			return [];
		}
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
