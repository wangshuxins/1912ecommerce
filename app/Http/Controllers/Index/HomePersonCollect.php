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
class HomePersonCollect extends Commons
{
    public function homepersoncollect(){
		$dingji=$this->daohanglan();
		$quanbu=$this->cateinfo();
		$id=request()->id;
		$goods=	GoodsModel::where("goods_id",$id)->get();
	  return view('Merchandise.Index.homepersoncollect',['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	
	}
	public function homepersonfootmark(){
		$dingji=$this->daohanglan();

		if($this->checkLogin()){

			$historyInfo = $this->TableDb();
		}else{

			$historyInfo = $this->TableCookie();
		}

		return view('Merchandise.Index.homepersonfootmark',['dingji'=>$dingji,'goods'=>$historyInfo]);
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
}
