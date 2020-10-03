<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CateGoryModel;
//商品
use App\Model\GoodsModel;
class CategoryController extends Controller
{
	//分类展示
    public function category(){
	  
	  $cate_id = request()->cate_id;
     
	  $where = [];

      if(!empty($cate_id)){

	     $where[] = ['cate_id','=',$cate_id];

	  }
      if(request()->ajax()){
	       $category = CateGoryModel::where('is_del',1)->where($where)->get();
	       $category = CreateTree($category);
	       return view('Merchandise.Admin.category.categoryajax',compact('category'));
	  }
	       $category = CateGoryModel::where('is_del',1)->where($where)->get();
	      $category = CreateTree($category);
	      return view('Merchandise.Admin.category.category',compact('category'));
	}
	//分类添加
	public function categoryedit(){
	  if(Request()->isMethod('get')){
	   $category = CateGoryModel::where('is_del',1)->get();
	    $category = CreateTree($category);
		return view('Merchandise.Admin.category.categoryedit',compact('category'));
	  }
	  if(Request()->isMethod('post')){
	    	
	     $post = Request()->all();

          $first = CateGoryModel::where('cate_name',$post['cate_name'])->first();

		  if($first){
		  
		     errorone('分类名称已存在!');
		  
		  }

          
		 if(empty($post['cate_name'])||empty($post['is_del'])||empty($post['is_nav_show'])){
		 
		    error('任意选项不能为空!');
		 }
	 
		$category = new CateGoryModel();

		$insert = $category::insert($post);

		if($insert){
		   
		   success("添加成功!");
		
		}
	  }
	}
	//分类删除
	public function categorydel($id){
		//查询分类下是否有之分类
		$desc = GoodsModel::where('cate_id',$id)->count();
		//判断分类下是否有商品
		if($desc <= 0){
			$name = CateGoryModel::where("parent_id",$id)->first();
			// dd($name);
			if(empty($name)){
				//修改展示字段
				$del = CateGoryModel::where("cate_id",$id)->update(["is_del"=>"2"]);
				//判断
				if($del){
					return redirect("/admin/category");
				}
			}else{
				return redirect("/admin/category")->with("get","分类下有子分类，请删除子分类再试！");
			}
		}else{
			return redirect("/admin/category")->with("get","商品中有子分类，请删除商品再试！");
		}
	}
	//判断子分类下是否有商品
	public function categoryudes(){
		$id = request()->post("a_id");
		//查询分类下是否有之分类
		$desc = GoodsModel::where('cate_id',$id)->count();
		if($desc > 0){
			return "you";
		}else{
			return "wu";
		}
	}
	//分类修改
	public function categoryupdate($id){
		//get请求
		if(request()->isMethod("get")){
			$category = CateGoryModel::where('is_del',1)->get();
		    $category = CreateTree($category);
			$name = CateGoryModel::where("cate_id",$id)->first();
			return view('Merchandise.Admin.category.update',compact('category',"name"));
		}
		//post请求
		if(request()->isMethod("post")){
	     $post = Request()->all();
          $first = CateGoryModel::where('cate_name',$post['cate_name'])->first();
		  if($first){
		     errorone('分类名称已存在!');
		  }
		  //不能为空
		 if(empty($post['cate_name'])||empty($post['is_del'])||empty($post['is_nav_show'])){
		    error('任意选项不能为空!');
		 }
	 	//实例化
		$category = new CateGoryModel();
		$insert = $category::where("cate_id",$id)->update($post);

		if($insert){
		   
		   success("修改成功!");
		
		}
		}
	}
	//点击是否显示
	public function check(Request $request){
		//接收值
		$cate_id=$request->input('cate_id');
		$field=$request->input('field');
		$_value=$request->input('_value');

		$where=[
			['cate_id','=',$cate_id]
		];
		$cate=CateGoryModel::where($where)->update([$field=>$_value]);
		if($cate){
			echo "ok";
		}else{
			echo "on";
		}
	}
	//即点即改
	public function check2(Request $request){
		//接收
		$_value=$request->input('_value');
		$_field=$request->input('_field');
		$cate_id=$request->input('cate_id');

		$where=[
			['cate_id','=',$cate_id]
		];

		$cate=CateGoryModel::where($where)->update([$_field=>$_value]);
		if($cate){
			echo "ok";
		}else{
			echo "on";
		}
	}

}
