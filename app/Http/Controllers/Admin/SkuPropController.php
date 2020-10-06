<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//sku
use App\Model\AttrModel;
class SkuPropController extends Controller
{
    //属性名新增
    public function addition(){
    	//判断请求
    	if(Request()->isMethod("get")){
    		return view("Merchandise.Admin.Property.save");
    	}
    	//判断请求
    	if(Request()->isMethod("post")){
    		$name = request()->post("attr_name");
    		$datas = [
    			"attr_name" => $name,
				"add_time" => time(),
				"is_del" => "1",
    		];
    		$data = AttrModel::insert($datas);
    		if($data){
    			return "/admin/display";
    		}else{
    			return redirect("/admin/addition")->with("get","文件错误");
    		}
    	}
    }
    //属性名展示
    public function display(){
    	$attr_name = request()->get("attr_name");
		$where = [];
		if($attr_name){
		    $where[] = ["attr_name","like","%$attr_name%"];
		}
    	$name = AttrModel::orderby("id","desc")->where("is_del","1")->where($where)->paginate(5);
    	if(Request()->Ajax()){
		    $name = AttrModel::orderby("id","desc")->where("is_del","1")->where($where)->paginate(5);
    		return view("Merchandise.Admin.Property.ajaxshow",["name"=>$name,"attr_name"=>$attr_name]);
    	}
    	return view("Merchandise.Admin.Property.show",["name"=>$name,"attr_name"=>$attr_name]);
    }
    //属性名删除
    public function deletion($id){
    	$name = AttrModel::where("id",$id)->update(["is_del"=>"2"]);
    	if($name){
    		return redirect("/admin/display");
    	}else{
    		return redirect("/admin/display")->with("get","删除失败");
    	}
    }
    //属性名修改
    public function update($id){
    	//判断请求
    	if(Request()->isMethod("get")){
    		$name = AttrModel::where("id",$id)->first();
    		return view("Merchandise.Admin.Property.update",["name"=>$name]);
    	}
    	//判断请求
    	if(Request()->isMethod("post")){
    		$name = request()->post("attr_name");
    		$datas = [
    			"attr_name" => $name,
				"add_time" => time(),
				"is_del" => "1",
    		];
    		$data = AttrModel::where("id",$id)->update($datas);
    		if($data){
    			return "/admin/display";
    		}else{
    			return redirect("/admin/addition")->with("get","文件错误");
    		}
    	}
    }

}
