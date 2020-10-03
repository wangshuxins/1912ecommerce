<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdModel;
class AdController extends Controller
{
    //

	public function index(){//列表
		
        $ad_name=request()->ad_name;

		$res=AdModel::where("is_del",0)->paginate(1);
			
		if(request()->ajax() ){
			
			
			//return $ad_name;
			$where=[];
			$where[]=['ad_name',"like","%$ad_name%"];

			$res=AdModel::OrderBy("ad_id","desc")->where("is_del",0)->where($where)->paginate(1);
				return view("Merchandise/Admin/ad/ajax",['res'=>$res,'ad_name'=>$ad_name]);
			}

			return view("Merchandise/Admin/ad/index",['res'=>$res,'ad_name'=>$ad_name]);

	}

	public function add(){//添加

		if(request()->isMethod("get")){



			return view("Merchandise/Admin/ad/add");
		}

		if(request()->isMethod("post")){

			$all=request()->all();
			$all['add_time']=time();

			//return $all;
			$a=AdModel::insert($all);
			if($a){
				return 1;
			}

		}


	}
	public function shan(){//删除
	$ad_id=	request()->ad_id;
		$res=AdModel::where("ad_id",$ad_id)->update(['is_del'=>1]);
		if($res){
			return 1;
		}


	}


	public function xiu(){//修改
		if(request()->isMethod("get")){
				//$id=request()->id;
			$res=AdModel::find(request()->id);
			//dd($res);
			return view("Merchandise/Admin/ad/xiu",['res'=>$res]);

		}

		if(request()->isMethod("post")){
				$all=request()->except(['id']);
			//$all=request()->all();
				$all['add_time']=time();
			//return $all;
      		 	$id=request()->id;
       			$res=  AdModel::where("ad_id",$id)->update($all);
       		if($res)
      		{
       			 return 1;
      		}
		}
	}




}
