<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//默认地址表
use App\Model\User_AddressModel as AddressModel;
//地址表
use App\Model\AreaModel;
//购物车表
use App\Model\CarModel;
//商品表
use App\Model\GoodsModel;
//DB
use DB;
//订单表
use App\Model\Order_GoodsModel;
//订单商品表
use App\Model\Order_InfoModel;
//订单地址表
use App\Model\Order_AddressModel;
class GetOrderInfoController extends Controller
{
	public function getorderinfo($id){
		$dingji = $this->daohanglan();
		$name = "订单";
		//用户id
		$user_id =session("users")['user_id'];
		//默认地址表
		$rderdata= $this->Default_address($user_id);
		//添加确认订单的商品
		$goods_name = $this->Goods_database($id,$user_id);
		$unit_price = $this->Goods_unit_price($goods_name);
		return view('Merchandise.Index.getorderinfo',compact('dingji','name','rderdata','goods_name',"unit_price"));
	}
	//默认地址表
	public function Default_address($user_id){
		$where = [
				"is_del"=>"0",
				"user_id"=>$user_id,
				"is_default"=>'1',
		];
		if(AddressModel::where($where)->get() == null){
			dd("请联系管理员，QQ");
		}
	//地址数据
	   $rderdata = AddressModel::where($where)->get()->toArray();
	   foreach($rderdata as $k=>$a){
		   	$rderdata[$k]["province"] = AreaModel::where("id",$a["province"])->first("name")->name;
		   	$rderdata[$k]["city"] = AreaModel::where("id",$a["city"])->first("name")->name;
		   	$rderdata[$k]["area"] = AreaModel::where("id",$a["area"])->first("name")->name;
	   }
	   return $rderdata;
	}
	//添加确认订单的商品
	public function Goods_database($goods_id,$user_id){
		$goods_descid = explode(",",$goods_id);
		$cary_name = [];
		foreach($goods_descid as $a){
			$where = [
					"shop_cary.is_del"=>"1",
					"shop_cary.goods_id"=>$a,
					"shop_cary.user_id"=>$user_id,
			];
			if(CarModel::where($where)->leftjoin("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")->first() == null){
				dd("请联系管理员，QQ:2382662404");
			}
			$cary_name[] = CarModel::where($where)->leftjoin("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")->first()->toArray();
		}
		return $cary_name;
	}
	//商品总价
	public function Goods_unit_price($goods_name){
		$unit_price = [];
		foreach($goods_name as $k=>$a){
			$unit_price[]=$a["goods_totall"];
		}
		$goods_price = array_sum($unit_price);
		return $goods_price;
	}
	//订单地址
	public function orderaddress(){
		if(Request()->isMethod("get")){
			$data = request()->post("data");
			$cary_name = AddressModel::where("id",$data)->first();
			return $cary_name;
		}
		if(Request()->isMethod("post")){
			//用户id
			$user_id =session("users")['user_id'];
			//商品ID
			$goods_id = request()->post("goods_id");
			//地址ID
			$cary_id = request()->post("cary_id");
			//支付方式
			$payname = request()->post("payname");
			//支付价格
			$total_price = request()->post("total_price");
			//#############################以下都是进库操作##########################################
			//订单方法
			$Order_Goods = $this->Goods_namedesc($user_id,$cary_id,$payname,$total_price,$goods_id);
			if($Order_Goods == true){
				return "成功";
			}else{
				return "失败";
			}
		}
	}
	//处理商品的方法
	public function Goods_namedesc($user_id,$cary_id,$payname,$total_price,$goods_id){
		//订单号
		$name  = mt_rand(100000,10000000);
		$time = time();
		$time_name = substr_replace($time,4,6);
		$order_number = $user_id.$time_name.$payname.$name;
		$Order_InfoModel = new Order_InfoModel;
		$Order_InfoModel->order_sn  = $order_number;
		$Order_InfoModel->user_id  = $user_id;
		$Order_InfoModel->order_status  = "1";
		$Order_InfoModel->address_id  = $cary_id;
		$Order_InfoModel->payname  = $payname;
		$Order_InfoModel->order_amount  = $total_price;
		$Order_InfoModel->add_time  = $time;
		$Order_InfoModel->is_del  = "1";
		$Order_Info = $Order_InfoModel->save();
		// 订单商品处理信息
		$order_id = Order_InfoModel::where(["order_sn"=>$order_number,"user_id"=>$user_id])->first("order_id");
		foreach($goods_id as $k=>$a){
			$cary_name = CarModel::where(["goods_id"=>$a,"is_del"=>"1","user_id"=>$user_id])->first();
			$Order_GoodsModel = new Order_GoodsModel;
			$Order_GoodsModel->user_id     = $user_id;
			$Order_GoodsModel->order_id    = $order_id->order_id;
			$Order_GoodsModel->goods_id    = $a;
			$Order_GoodsModel->goods_prices = $cary_name->goods_totall;
			$Order_GoodsModel->buy_number  = $cary_name->buy_number;
			$Order_Goods  = $Order_GoodsModel->save();
		}
		//订单默认地址表
		$Add_name = AddressModel::where(["id"=>$cary_id,'is_del'=>"0","user_id"=>$user_id])->first();
		$province = AreaModel::where("id",$Add_name->province)->first("name");
		$city = AreaModel::where("id",$Add_name->city)->first("name");
		$area = AreaModel::where("id",$Add_name->area)->first("name");
		$Order_AddressModel = new Order_AddressModel;
		$Order_AddressModel->address_name  =  $Add_name->user_name;
		$Order_AddressModel->address_tel  =  $Add_name->tel;
		$Order_AddressModel->province  =  $province->name;
		$Order_AddressModel->city  =  $city->name;
		$Order_AddressModel->area  =  $area->name;
		$Order_AddressModel->order_id  =  $order_id->order_id;
		$Order_Address = $Order_AddressModel->save();
		//判断是否成功
		if($Order_Address !== true || $Order_Goods !== true || $Order_Info !== true){
			return false;
		}
		foreach($goods_id as $k=>$a){
			$Car_del = CarModel::where(["goods_id"=>$a,"is_del"=>"1","user_id"=>$user_id])->update(["is_del"=>"0"]);
		}

		return "true";
	}















}
?>