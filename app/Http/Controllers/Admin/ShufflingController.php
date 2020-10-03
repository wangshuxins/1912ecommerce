<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SlideModel;
class ShufflingController extends Controller
{
    //添加图片
    public function shufflingsave(){
    	if(request()->isMethod("get")){
    		return view("Merchandise.Admin.Shuffling.graphadd");
    	}
    	if(request()->isMethod("post")){
    		//接参数
	        $fileCharater = $_FILES["Filedata"];
	        //赋变量
	        $name =  $fileCharater["tmp_name"];
	        //截取后缀名
	        $ext = explode('.',$fileCharater["name"])[1];
	        //重新赋变量
	        $newfileName = MD5(time()).".".$ext;
	        //拼接
	        $newfilePath = "uploads/".$newfileName;
	        // 函数将上传的文件移动到新位置
	        move_uploaded_file($name,$newfilePath);
	        //返回参数
	        echo $newfilePath;
    	}
    }
    //添加轮播图
    public function shuinsert(){
    	$name = request()->post();
		$SlideModel = new SlideModel;
		$SlideModel->url =$name["url_desc"];
		$SlideModel->slide_weight =$name["silde_weight"];
		$SlideModel->is_show =$name["is_show"];
		$SlideModel->img_path =$name["img_path"];
		$SlideModel->add_time =time();
		$data = $SlideModel->save();
		if($data){
			return "/admin/shufflingshow";
		}
    }
    //展示
    public function shufflingshow(){
    	$SlideModel = SlideModel::where("is_del","1")->orderBY("slide_id","desc")->paginate(3);
    	if(request()->Ajax()){
    		return view("Merchandise.Admin.Shuffling.ajaxshow",["Slide"=>$SlideModel]);
    	}
    	return view("Merchandise.Admin.Shuffling.graphsave",["Slide"=>$SlideModel]);
    }
    //删除
    public function shufflingdel($id){
    	$shufflingdel = SlideModel::where("slide_id",$id)->update(["is_del"=>2]);
    	if($shufflingdel){
    		return redirect("/admin/shufflingshow");
    	}
    }
    //修改
	public function shufflingupdate($id){
		if(request()->isMethod("get")){
			$name = SlideModel::where("slide_id",$id)->first();
			return view("Merchandise.Admin.Shuffling.graphupd",["name"=>$name]);
		}
		if(request()->isMethod("post")){
	    	$name = request()->post();
	    	$data = [
				"url" => $name["url_desc"],
				"slide_weight" => $name["silde_weight"],
				"is_show" => $name["is_show"],
				"img_path" => $name["img_path"],
				"add_time" => time(),
	    	];
			$SlideModel = SlideModel::where("slide_id",$id)->update($data);
			if($SlideModel){
				return "/admin/shufflingshow";
			}
		}
	}


}
