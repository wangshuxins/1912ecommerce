<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CateGoryModel;
use App\Model\BrandModel;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    public function goodsedit(){

		if(request()->isMethod('get')){
			
			$goods_sn = (str_shuffle(uniqid()).".".sha1(time()).".".rand(0,99));
			$category = CateGoryModel::where('is_show',1)->get();
			$category = CreateTree($category);
			$brand = BrandModel::where('brand_show',1)->get();
			return view('Merchandise.Admin.goods.goodsedit',compact('category','brand',"goods_sn"));
		}

		if(request()->isMethod('post')){
			$goods_name = request()->goods_name;
			$goods_price = request()->goods_price;
			$goods_sn = request()->goods_sn;
			$goods_store = request()->goods_store;
			$goods_score = request()->goods_score;
			$cate_id = request()->cate_id;
			$brand_id = request()->brand_id;
			$is_show = request()->is_show;
			$is_up = request()->is_up;
			$is_new = request()->is_new;
			$is_hot = request()->is_hot;
			$contents = request()->contents;
			$first = GoodsModel::where('goods_name',$goods_name)->first();

			if($first){

				errorone('商品名字已存在!');
			}

		
			if(empty($goods_name)||empty($goods_price)||
					empty($goods_sn)||empty($goods_store)
					||empty($cate_id)||empty($brand_id)||empty($contents)){
                      error('任何选项不能为空!');
			}
			if(empty(request()->goods_img)){
				echo json_encode(['error_no'=>3,'error_msg'=>'文件未上传!']);exit;
			}
			if(empty(request()->goods_imgs)){
				echo json_encode(['error_no'=>4,'error_msg'=>'多文件未上传!']);exit;
			}
			$file = upload('goods_img');
			$files = Moreupload('goods_imgs');

			$data = [
			        'goods_img'=>	$file,
				    'goods_imgs'=>implode(',',$files),
				    'goods_name'=>$goods_name,
				    'goods_price'=>$goods_price,
				    'goods_sn'=>$goods_sn,
					'goods_store'=>$goods_store,
					'goods_score'=>$goods_score,
				    'cate_id'=>$cate_id,
				    'brand_id'=>$brand_id,
					'is_show'=>$is_show,
					'is_new'=>$is_new,
				    'is_up'=>$is_up,
				    'is_hot'=>$is_hot,
					'add_time'=>time(),
					'goods_desc'=>$contents


			];

            $goods = new GoodsModel();
			$goods = $goods::insert($data);

			if($goods){
				success('添加成功');
			}
		}
	
	}
	 public function goods(){

       $goods_name=request()->goods_name;

	   $where=[];
	   if(!empty($goods_name)){
		   $where[]=['goods_name','like',"%$goods_name%"];
	   }
	
	   $goods = GoodsModel::orderBy('goods_id','desc')->select('shop_goods.*','brand_name','cate_name')->where('shop_goods.is_del',1)->where($where)
			   ->leftjoin('shop_brand','shop_brand.brand_id','=','shop_goods.brand_id')
			   ->leftjoin('shop_cate','shop_cate.cate_id','=','shop_goods.cate_id')
			   ->paginate(2);
		if(request()->ajax()){
			return view('Merchandise.Admin.goods.goodsajax',compact('goods','goods_name'));
		}
	           return view('Merchandise.Admin.goods.goods',compact('goods','goods_name'));
	
	}
	public function delete(){
	
	    $goods_id = request()->goods_id;

		$goods = GoodsModel::where('goods_id',$goods_id)->update(['is_del'=>2]);

		if($goods){
		    success('删除成功');
		}
	}
	public function update($goods_id){
	
	        $category = CateGoryModel::where('is_show',1)->get();
			$category = CreateTree($category);
			$brand = BrandModel::where('brand_show',1)->get();
			$goods = GoodsModel::where('goods_id',$goods_id)->first();
			return view('Merchandise.Admin.goods.goodsupdate',compact('category','brand','goods'));
	    
	}
	public function updated(){
		   if(empty(request()->goods_img)&&empty(request()->goods_imgs)){

			   $goods_name = request()->goods_name;
			   $goods_price = request()->goods_price;
			   $goods_sn = request()->goods_sn;
			   $goods_store = request()->goods_store;
			   $goods_score = request()->goods_score;
			   $cate_id = request()->cate_id;
			   $brand_id = request()->brand_id;
			   $is_show = request()->is_show;
			   $is_up = request()->is_up;
			   $is_new = request()->is_new;
			   $is_hot = request()->is_hot;
			   $contents = request()->contents;
			   $goods_id = request()->goods_id;
			   $where = [
					   ['goods_id','<>',$goods_id],
					   ['goods_name',$goods_name]
			   ];
			   $first = GoodsModel::where($where)->first();

			   if($first){
				   errorone('商品名字已存在!');
			   }
			   $data = [
					   'goods_name'=>$goods_name,
					   'goods_price'=>$goods_price,
					   'goods_sn'=>$goods_sn,
					   'goods_store'=>$goods_store,
					   'goods_score'=>$goods_score,
					   'cate_id'=>$cate_id,
					   'brand_id'=>$brand_id,
					   'is_show'=>$is_show,
					   'is_new'=>$is_new,
					   'is_up'=>$is_up,
					   'is_hot'=>$is_hot,
					   'add_time'=>time(),
					   'goods_desc'=>$contents
			   ];
		   }else if(empty(request()->goods_img)){
			   $files = Moreupload('goods_imgs');
			   $goods_name = request()->goods_name;
			   $goods_price = request()->goods_price;
			   $goods_sn = request()->goods_sn;
			   $goods_store = request()->goods_store;
			   $goods_score = request()->goods_score;
			   $cate_id = request()->cate_id;
			   $brand_id = request()->brand_id;
			   $is_show = request()->is_show;
			   $is_up = request()->is_up;
			   $is_new = request()->is_new;
			   $is_hot = request()->is_hot;
			   $contents = request()->contents;
			   $goods_id = request()->goods_id;
			   $where = [
					   ['goods_id','<>',$goods_id],
					   ['goods_name',$goods_name]
			   ];
			   $first = GoodsModel::where($where)->first();

			   if($first){
				   errorone('商品名字已存在!');
			   }
			   $data = [
					   'goods_imgs'=>implode(',',$files),
					   'goods_name'=>$goods_name,
					   'goods_price'=>$goods_price,
					   'goods_sn'=>$goods_sn,
					   'goods_store'=>$goods_store,
					   'goods_score'=>$goods_score,
					   'cate_id'=>$cate_id,
					   'brand_id'=>$brand_id,
					   'is_show'=>$is_show,
					   'is_new'=>$is_new,
					   'is_up'=>$is_up,
					   'is_hot'=>$is_hot,
					   'add_time'=>time(),
					   'goods_desc'=>$contents
			   ];
		   }else if(empty(request()->goods_imgs)){
			   $file = upload('goods_img');
			   $goods_name = request()->goods_name;
			   $goods_price = request()->goods_price;
			   $goods_sn = request()->goods_sn;
			   $goods_store = request()->goods_store;
			   $goods_score = request()->goods_score;
			   $cate_id = request()->cate_id;
			   $brand_id = request()->brand_id;
			   $is_show = request()->is_show;
			   $is_up = request()->is_up;
			   $is_new = request()->is_new;
			   $is_hot = request()->is_hot;
			   $contents = request()->contents;
			   $goods_id = request()->goods_id;
			   $where = [
					   ['goods_id','<>',$goods_id],
					   ['goods_name',$goods_name]
			   ];
			   $first = GoodsModel::where($where)->first();

			   if($first){
				   errorone('商品名字已存在!');
			   }
			   $data = [
					   'goods_img'=>	$file,
					   'goods_name'=>$goods_name,
					   'goods_price'=>$goods_price,
					   'goods_sn'=>$goods_sn,
					   'goods_store'=>$goods_store,
					   'goods_score'=>$goods_score,
					   'cate_id'=>$cate_id,
					   'brand_id'=>$brand_id,
					   'is_show'=>$is_show,
					   'is_new'=>$is_new,
					   'is_up'=>$is_up,
					   'is_hot'=>$is_hot,
					   'add_time'=>time(),
					   'goods_desc'=>$contents
			   ];
		   }else{
			   $file = upload('goods_img');
			   $files = Moreupload('goods_imgs');
			   $goods_name = request()->goods_name;
			   $goods_price = request()->goods_price;
			   $goods_sn = request()->goods_sn;
			   $goods_store = request()->goods_store;
			   $goods_score = request()->goods_score;
			   $cate_id = request()->cate_id;
			   $brand_id = request()->brand_id;
			   $is_show = request()->is_show;
			   $is_up = request()->is_up;
			   $is_new = request()->is_new;
			   $is_hot = request()->is_hot;
			   $contents = request()->contents;
			   $goods_id = request()->goods_id;
			   $where = [
					   ['goods_id','<>',$goods_id],
					   ['goods_name',$goods_name]
			   ];
			   $first = GoodsModel::where($where)->first();

			   if($first){
				   errorone('商品名字已存在!');
			   }
			   $data = [
					   'goods_img'=>	$file,
					   'goods_imgs'=>implode(',',$files),
					   'goods_name'=>$goods_name,
					   'goods_price'=>$goods_price,
					   'goods_sn'=>$goods_sn,
					   'goods_store'=>$goods_store,
					   'goods_score'=>$goods_score,
					   'cate_id'=>$cate_id,
					   'brand_id'=>$brand_id,
					   'is_show'=>$is_show,
					   'is_new'=>$is_new,
					   'is_up'=>$is_up,
					   'is_hot'=>$is_hot,
					   'add_time'=>time(),
					   'goods_desc'=>$contents
					   ];
		   }
            $goods = new GoodsModel();
			$goods = $goods::where('goods_id',$goods_id)->update($data);
			if($goods){
				success('修改成功');
		}
	}
	//即点即改
	public function check(Request $request){
		//接收传过来的值
		$_value=$request->input('_value');
		$_field=$request->input('_field');
		$_goods_id=$request->input('_goods_id');
		//where条件
		$where=[
			['goods_id','=',$_goods_id]
		];
		$goods=GoodsModel::where($where)->update([$_field=>$_value]);
		if($goods){
			echo "ok";
		}else{
			echo "on";
		}
	}
	//点即是否显示
	public function check2(Request $request){
		//接收值
	 		$goods_id=$request->input('_goods_id');
            $_field=$request->input('_field');
			$_value=$request->input('_value');
			
			$where=[
				['goods_id','=',$goods_id]
			];
			$goods=GoodsModel::where($where)->update([$_field=>$_value]);
			if($goods){
				echo "ok";
			}else{
				echo "on";
			}

	}
}
