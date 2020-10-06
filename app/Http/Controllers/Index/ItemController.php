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
//SKU关联表
use App\Model\AttrSkuModel;
//属性值
use App\Model\AttrvalModel;
//属性名
use App\Model\AttrModel;
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
		//####################################SKU#################################################
		$name = AttrSkuModel::where(["goods_id"=>$id,"is_del"=>'1'])->get()->toArray();
		$Attr = [];
		$attrval = [];
		foreach($name as $k=>$a){
			$sku = explode(":",$a["sku"]);
			foreach($sku as $k=>$a){
				//#########################sku属性名查询###########################################
				$key = strstr($a,",",true);
				$attr_name = AttrModel::where("id",$key)->first();
				$Attr[$key] =[
					"id"=>$attr_name->id,
					"attr_name"=>$attr_name->attr_name,
				];
				//#########################sku属性值查询###########################################
				$keys_name = substr($a,strlen($a)-1,1);
				$attrval_name = AttrvalModel::where("id",$keys_name)->first();
				$attrval[$attrval_name->attrval_name] = [
					"attrval_name"=>$attrval_name->attrval_name,
					"attr_id"=>$attrval_name->attr_id,
					"id"=>$attrval_name->id,
				];
				//#########################sku属性值查询###########################################
			}
		}
		//####################################SKU#################################################
       return view("Merchandise.Index.item",['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods,"Attr"=>$Attr,"attrval"=>$attrval]);
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
	// SKU修改方法
	public function Sku_prtdetails(){
		$goods_id = Request()->post("goods_id");
		$attr_id = Request()->post("attr_id");
		$attr_id = implode(":",$attr_id);
		if(!isset($goods_id)){
			error("请先确认商品");
		}
		$attrval = AttrSkuModel::where(["goods_id"=>$goods_id,"is_del"=>'1'])->get()->toArray();
		foreach($attrval as $k=>$a){
			$sku = $a["sku"];
			$where = [
				"goods_id"=>$goods_id,
				"sku"=>$sku,
				"is_del"=>'1',
			];
			if($attr_id == $sku){
				$name = AttrSkuModel::where($where)->first();
				ajax("查询成功",$name);
			}
		}
	}






}
