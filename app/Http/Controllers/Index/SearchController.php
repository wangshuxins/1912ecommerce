<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CategoryModel;
use App\Model\GoodsModel;
use App\Model\BrandModel;
use Illuminate\Support\Facades\Cookie;
use App\Model\carModel;
class SearchController extends Controller
{
	public function search(){
		$dingji=$this->daohanglan();//导航栏顶级类型
		$quanbu=$this->cateinfo();//数组
		$id=request()->id;
		$cateInfo = CategoryModel::where('is_del',1)->get()->toArray();
		$find = getCateId($cateInfo,$id);
		Cookie::queue('cate_id',serialize($find));
		$sj = [
				['is_del','=',1],
				['is_show','=',1],
				['is_del','=',1]
		];
		$pids = GoodsModel::select('brand_id')->where($sj)->whereIn('cate_id',$find)->get()->toArray();

		$array = [];
		foreach($pids as $k=>$v){
			$array[$v["brand_id"]]=$v;
		}
		$brand = BrandModel::whereIn('brand_id',$array)->limit('18')->get();
		//获取价格区间
		$max_price = GoodsModel::whereIn('cate_id',$find)->max('goods_price');
		$priceInfo = $this->getPriceSection($max_price);
		//获取商品数据
		$p = 0;
		$page_num = 10;
		$limit = GoodsModel::where($sj)->whereIn('cate_id',$find)->offset($p)->limit($page_num)->get();
		//$limit = GoodsModel::where($sj)->whereIn('cate_id',$find)->get();
		//dump(db::getLastSql());exit;
		$count = GoodsModel::whereIn('cate_id',$find)->count();
		$page_count = ceil($count/$page_num);
		$str = "";
		for($i=1;$i<=$page_count;$i++){
			if($p==$i){
				$str.="<a class='pag' href='javascript:void(0)'>".$i."</a>";
			}else{
				$str.="<a class='pag' href='javascript:void(0)'>".$i."</a>";
			}
		}
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
		return view('Merchandise.Index.search',compact('car','dingji','brand','priceInfo','limit','str','id','quanbu'));
	}
	public function getPriceSection($max_price){

		$price = $max_price/7;//1000

		$priceInfo = [];

		for($i=0;$i<=6;$i++){

			$satrt = $price*$i;

			$end = $price*($i+1)-0.01;

			$priceInfo[] = number_format($satrt,2).'-'.number_format($end,2);

		}
		$priceInfo[] = $max_price.'以上';
		return $priceInfo;
	}
	public function brand(){

		$brand_id = Request()->input('brand_id');
		$cate_id = Request()->cookie('cate_id');
		$cate_ids = unserialize($cate_id);

		$max_price = GoodsModel::where('brand_id',$brand_id)->whereIn('cate_id',$cate_ids)->max('goods_price');

		$priceInfo = $this->getPriceSection($max_price);

		return view('Merchandise.Index.searchajax',['priceInfo'=>$priceInfo]);

	}
	public function indexlist(){

		$brand_id = Request()->input('brand_id');

		$goods_price =  Request()->input('goods_price');

		$field =  Request()->input('field');

		$cate_id = Request()->cookie('cate_id');

		$cate_ids = unserialize($cate_id);

		$p =  Request()->input('p');

		if($p){
			$p = ($p-1);
		}
		$where = [];

		if(!empty($brand_id)){

			$where[] = ['brand_id','=',$brand_id];

		}
		if(!empty($field)){
			$where[] = [$field,'=',1];
		}
		if(!empty($goods_price)){
			if(substr_count($goods_price,'-')>0){
					$str_replace = str_replace('-',' ',$goods_price);
					$str_replace = explode(' ',$str_replace);
			}else{
				$goods_price = (float)$goods_price;
				$where[] = ['goods_price','>=',$goods_price];
			}
		}
		$page_num = 10;
         if(!empty($str_replace)){
			 $limit = GoodsModel::where($where)->whereIn('cate_id',$cate_ids)->whereBetween('goods_price',[$str_replace[0],$str_replace[1]])->offset($p)->limit($page_num)->get();
			 $count = GoodsModel::where($where)->whereIn('cate_id',$cate_ids)->whereBetween('goods_price',[$str_replace[0],$str_replace[1]])->count();
		 }else{
			 $limit = GoodsModel::where($where)->whereIn('cate_id',$cate_ids)->offset($p*10)->limit(10)->get();
			 $count = GoodsModel::where($where)->whereIn('cate_id',$cate_ids)->count();
		 }
		$page_count = ceil($count/$page_num);
		$str = "";
		for($i=1;$i<=$page_count;$i++){
			if($p==$i){
				$str.="<a href='javascript:void(0)' class='pag'>".$i."</a>";
			}else{

				$str.="<a href='javascript:void(0)' class='pag'>".$i."</a>";
			}
		}
		return view('Merchandise.Index.showdiv',['limit'=>$limit,'str'=>$str]);

	}
	public function price(){
		$cate_id = Request()->cookie('cate_id');
		$cate_ids = unserialize($cate_id);
		//获取价格区间
		$max_price = GoodsModel::whereIn('cate_id',$cate_ids)->max('goods_price');
		$priceInfo = $this->getPriceSection($max_price);
		if(Request()->ajax()){
			return view('Merchandise.Index.priceajax',compact('priceInfo'));
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
