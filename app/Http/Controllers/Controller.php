<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Model\CategoryModel;
class Controller extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function daohanglan(){
		$res=CategoryModel::get();//全部分类数据
		$dingji=CategoryModel::where([['parent_id','=',0],['is_nav_show','=',1]])->limit(6)->get();//导航栏顶级类型
		return $dingji;
	}
	public function cateinfo(){
			   $cateinfo=CategoryModel::where([['parent_id','=',0],['is_nav_show','=',1]])->limit(6)->get();
			   //所有 顶级id 而且 cate_nav_show =1 是显示的
			   //dd($cateinfo);

		$zhi=CategoryModel::get()->Toarray();
		//dump($zhi);
		//处理好的 categoryinfo
		$categoryinfo=$this->getlistinfo($zhi);	
		return $categoryinfo;
	}
	function getlistinfo($zhi,$parent_id=0){
				$arr=[];
			foreach($zhi as $k=>$v){
				//dump($v['cate_name']);
				if($v['parent_id']==$parent_id){
				//	dump($v['cate_name']);
				$child=$this->getlistinfo($zhi,$v['cate_id']);
				$v['child']=$child;
				$arr[]=$v;
				}
			}
			return $arr;
	}
}
