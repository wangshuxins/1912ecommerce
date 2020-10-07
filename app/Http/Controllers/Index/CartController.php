<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CarModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Index\Common As Commons;
use App\Model\AttrSkuModel;
class CartController extends Commons
{
	public function savecar()
	{
		$goods_id = request()->goods_id;
		$goods_num = request()->goods_num;
		$goods_totall = request()->goods_totall;
		$users = session("users");//用户信息
		$sku = request()->sku;
		//dump($users);
		if($this->checkLogin()){//说明session存在是登录时加入购物车的
			$user_id = $users->user_id;//用户ID
			$tiaojian = CarModel::where("user_id", $user_id)->where("goods_id", $goods_id)->first();
			//查看之前有没有添加过此商品
			if (!$tiaojian) {
				$data = [
						"user_id" => $user_id,//用户ID
						"goods_id" => $goods_id,//商品ID
						"buy_number" => $goods_num,//购买数量
						"goods_totall" => $goods_totall,//总价
						"add_time" => time(),//时间
						"is_del" => 1
				];
				$res = CarModel::insert($data);
			} else {

				$data = [
						"user_id" => $user_id,//用户ID
						"goods_id" => $goods_id,//商品ID
						"buy_number" => $goods_num + $tiaojian->buy_number,//购买数量
						"goods_totall" => $goods_totall + $tiaojian->goods_totall,//总价
						"add_time" => time(),//时间
						"is_del" => 1
				];
				$sums = AttrSkuModel::select("goods_store")->where("sku",$sku)->where("goods_id",$goods_id)->first()->toArray();
				$goods_sum = ($sums['goods_store']);
				$sumx = CarModel::select("buy_number")->where("goods_id", $goods_id)->where("goods_id", $goods_id)->first()->toArray();
				$buy_numberx = ($sumx['buy_number']);

				$goods_count = $goods_num+$buy_numberx;

				if($goods_count>$goods_sum){

					return 3;
				}

				$res = CarModel::where("cary_id", $tiaojian->cary_id)->update($data);
			}
			if ($res) {
				return 1;
			}
		} else {
			//当购物车为空时
			$cartInfo =[];
			$cartInfos = Cookie::get('cartInfo');
			$cartInfo = unserialize($cartInfos);

			if(!empty($cartInfo)){

				if(array_key_exists($goods_id,$cartInfo)){

					$result = $this->checkGoodsNum($goods_num,$goods_id,$cartInfo[$goods_id]['buy_number']);

					if(empty($result)){

						return 2;

					}
					$cartInfo[$goods_id]['buy_number']=$cartInfo[$goods_id]['buy_number']+$goods_num;
				}else{

					$result = $this->checkGoodsNum($goods_num,$goods_id);

					if(empty($result)){
						return 2;
					}

					$cartInfo[$goods_id] = ['goods_id'=>$goods_id,'buy_number'=>$goods_num,'add_time'=>time()];

				}

			}else{

				$result = $this->checkGoodsNum($goods_num,$goods_id);

				if(empty($result)){

					return 2;

				}
				$cartInfo = [
						$goods_id=>['goods_id'=>$goods_id,'buy_number'=>$goods_num,'add_time'=>time()]
				];
			}
			Cookie::queue('cartInfo',serialize($cartInfo));
			return 1;
		}
	}
##################################################################################################################################################
	//购物车列表 ---登录状态
    public function cart(){

		if($this->checkLogin()){

			$car = $this->buyListDb();

		}else{

			$car = $this->buyListCookie();

		}
		if(empty($car)){
		
		$car = [];
		
		}
		return view("Merchandise.Index.cart",compact('car'));

	}
    //购物车列表 ---DB
	public function buyListDb(){

		$user_id = $this->sessionUserId();
		$where = [
				['user_id','=',$user_id],
				['shop_cary.is_del','=',1]
		];

		$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
				->where($where)
				->orderBy('shop_cary.add_time','desc')
				->get()->toArray();
		      return $car;
	}
    //购物车购买数量
	public function changeNumber(){
		$goods_id = Request()->input("goods_id");

		$buy_number = Request()->input("buy_number");

		$user_id = $this->sessionUserId();

		$where = [
				['user_id','=',$user_id],
				['goods_id','=',$goods_id],
				['is_del','=',1]
		];
        $goods_price = GoodsModel::select('goods_price')->where('goods_id',$goods_id)->first()->toArray();
		$goods_price = $goods_price['goods_price'];
		$goods_totall = $buy_number*$goods_price;
		$res = CarModel::where($where)->update(['buy_number'=>$buy_number,'goods_totall'=>$goods_totall]);
		if($res!==false){
			success("修改成功");
		}else{
			error("操作失败");
		}
	}
	//购物车小计
    public function getTotal(){

		$goods_id = Request()->input("goods_id");

		$user_id = $this->sessionUserId();

		$where = [
				['shop_goods.goods_id','=',$goods_id],
				['user_id','=',$user_id],
				['shop_cary.is_del','=',1]
		];

		$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
				->where($where)
				->first();

		echo $sj = $car['buy_number']*$car['goods_price'];exit;
	}
	//总价
	public function getMoney(){
		$goods_id = Request()->input("goods_id");

		$goods_id = explode(',',$goods_id);


		$user_id = $this->sessionUserId();

		$where = [
				['user_id','=',$user_id],
				['shop_cary.is_del','=',1]
		];
		$car = CarModel::join("shop_goods","shop_cary.goods_id","=","shop_goods.goods_id")
				->where($where)
				->whereIn('shop_cary.goods_id',$goods_id)
				->get();
		if(!empty($car[0])){
			$MoneyAll = 0;
			foreach($car as $k=>$v){
				$MoneyAll+=$v['goods_price']*$v['buy_number'];
			}
			echo $MoneyAll;exit;
		}
	}
	//删除
	public function del(){
		$goods_id=request()->goods_id;
		//return 1234;
		    $data=["add_time"=>time(),"is_del"=>0];
			$res=CarModel::where("goods_id",$goods_id)->update($data);
			if($res){
				success("删除成功");
			}
	}
	//批量删除
	public function carDel(){
		$goods_id = Request()->input('goods_id');

		$goods_id = explode(',',$goods_id);

		$user_id = $this->sessionUserId();

		$where = [
				['user_id','=',$user_id]
		];

		$ret = CarModel::where($where)->whereIn('shop_cary.goods_id',$goods_id)->update(['shop_cary.is_del'=>0]);
       //dump(db::getLastSql());exit;
		if($ret!==false){
			success('删除成功');
		}else{
			error("删除失败");
		}
	}
	//购物车列表 ---未登录状态
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
	//--------重新找回删除商品--------------
	public function chongxin(){
		$cary_id=request()->cary_id;
		//return 1234;
				$data=["add_time"=>time(),"is_del"=>1];
			$res=CarModel::where("cary_id",$cary_id)->update($data);		
			return "重新加入成功";

	}
    public function successcart(){
		 return view("Merchandise.Index.successcart");
	}
}
