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
class ItemController extends Controller
{

    public function item(){



    	// $goods_id = request()->get("goods_id");
    	// //调用浏览记录方法
    	// $History = $this->saveHistryCookie($goods_id);
    	// if($History == false){
    	// 	return "浏览记录正在处理，请稍后再试！";
    	// } 

    	//商品的分类
    	$dingji=$this->daohanglan();
    	$quanbu=$this->cateinfo();
    	$id=request()->id;
    	//dd($id);
    	$goods=	GoodsModel::where("goods_id",$id)->get();
    		//dd($goods);
    	//接过来的商品id
       return view("Merchandise.Index.item",['dingji'=>$dingji,"quanbu"=>$quanbu,'goods'=>$goods]);
	}

	//浏览记录
	public function saveHistryCookie($goods_id){
		//从session中获取用户id
		$user_id = session("login");
		// session(["login"=>"1"]);
		// session()->save();
		// dd($user_id);
		//当前时间戳
		$time = time();
		if($user_id){
			//用户登录成功
			$where = [
				"goods_id"=>$goods_id,
				"user_id"=>$user_id,
				"is_del"=>"1",
			];
			$name = HistoryModel::where($where)->first();
			if($name){
				$user = HistoryModel::where("h_id",$name["h_id"])->update(["update_time"=>$time]);
				if(!$user){
					return false;
				}else{
					return true;
				}
			}else{
				$History = new HistoryModel;
				$History->user_id=$user_id;
				$History->goods_id=$goods_id;
				$user = $History->add_time=$time;
				if(!$user){
					return false;
				}else{
					return true;
				}
			}
		}else{
			//用户未登录
			//检查cookie是否有值
			$cartInfo=empty($_COOKIE["historyInfo"]);
			if(!$cartInfo){
				//有cookie
				$name = unserialize($_COOKIE["historyInfo"]);
				if($name["goods_id"] == $goods_id){
					//存在商品
					$name["add_time"]=$time;
					$user_infoss = serialize($name);
					setCookie("historyInfo",$user_infoss);
					// dd($name);
					// setCookie("historyInfo",$name);

				}
			
			}	
				//没有cookie
				//$_SERVER['REMOTE_ADDR']
				//serialize将数组进行序列化
				// serialize
				// unserialize
				//serialize将数组进行反序列化
				$user_info = array('goods_id'=>$goods_id,"add_time"=>$time);
				$user_infoss = serialize($user_info);
				setCookie("historyInfo",$user_infoss);
		}
			// cookie("cartInfo",$cartInfo);
			// dd(empty($cartInfo));
			// dd(Cookie("cartInfo","2"));
			// $user_info = array('goods_id'=>$goods_id,"add_time"=>$time);
			// $user_info = serialize($user_info);
			// setCookie("historyInfo",$user_info);
		return true;
	}	
	//取出浏览记录
	public function ToBrowsing(){
		//判断登录
		$user_id = session("login");
		if($user_id){
			// $name = HistoryModel::where("user_id",$user_id)->get()->toArray();
			// $data=[];
			// foreach($name as $k=>$a){
			// 	$desc_name = GoodsModel::where("goods_id",$a["goods_id"])->get()->toArray();
			// 	$data[] = $desc_name;
			// }
			// dd($data);
			// return $data;
		}
		}












	
}
