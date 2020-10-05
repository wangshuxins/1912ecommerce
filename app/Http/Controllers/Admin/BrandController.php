<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
class BrandController extends Controller
{
	public function index(){

        $brand_name=request()->brand_name;
		$where=[];

		if(!empty($brand_name)){
			$where[]=['brand_name','like',"%$brand_name%"];
		}
		$brand = BrandModel::orderBy('brand_id','desc')->where('is_del',1)->where($where)->paginate(2);
         if(request()->ajax()){
			return view('Merchandise.Admin.brand.brandlistajax',compact('brand','brand_name'));
		 }
	

		return view('Merchandise.Admin.brand.brandlist',compact('brand','brand_name'));
	}
	public function brand(){
		if(request()->isMethod('get')){

			return view('Merchandise.Admin.brand.brand');
		}

		if(request()->isMethod('post')){


 
			$brand_name = request()->brand_name;

			$brand_url = request()->brand_url;

			$brand_show = request()->brand_show;

			$first = BrandModel::where('brand_name',$brand_name)->first();

			if($first){

				errorone('品牌名称已存在!');

			}


			if(empty($brand_name)||empty($brand_url)||empty($brand_show)){

				error("任何选项不能为空!");

			}
			if(empty($_FILES['crowd_file'])){
				echo json_encode(['error_no'=>3,'error_msg'=>'文件未上传!']);exit;
			}
			$file = upload('crowd_file');
			$data = [

					'brand_log'=>$file,
					'brand_name'=>$brand_name,
					'brand_url'=>$brand_url,
					'brand_show'=>$brand_show,
					'add_time'=>time()

			];
			$brandModel = new BrandModel();



			$brand = $brandModel::insert($data);


			if($brand){

				success('添加成功');

			}
		}
	}
	//软删除
	public function del(){
		//接收品牌id
		$brand_id=request()->brand_id;
		//条件
		$where=[
				['brand_id','=',$brand_id]
		];
		$brand=BrandModel::where($where)->update(["is_del"=>2]);
		if($brand){
			success('删除成功');
		}else{
			error('删除失败');
		}
	}
	public function exit($id){

		$brand=BrandModel::where('brand_id',$id)->first();
		return view('Merchandise.Admin.brand.exitadd',compact('brand'));
	}
	public function exitadd(){
		if(request()->isMethod('get')){

			return view('Merchandise.Admin.brand.exitadd');
		}

		if(request()->isMethod('post')){

			if(empty($_FILES['crowd_file'])){

				$brand_name = request()->brand_name;

				$brand_url = request()->brand_url;

				$brand_show = request()->brand_show;

				$brand_id = request()->brand_id;

				$where = [
						["brand_name", '=', $brand_name],
						['brand_id', '<>', $brand_id]
				];

				$first = BrandModel::where($where)->first();

				if ($first) {
					errorone('品牌名称已存在!');
				}

				$data = [
						'brand_name' => $brand_name,
						'brand_url' => $brand_url,
						'brand_show' => $brand_show,
						'add_time' => time()

				];
			}else {

				$file = upload('crowd_file');

				$brand_name = request()->brand_name;

				$brand_url = request()->brand_url;

				$brand_show = request()->brand_show;

				$brand_id = request()->brand_id;

				$where = [
						["brand_name", '=', $brand_name],
						['brand_id', '<>', $brand_id]
				];

				$first = BrandModel::where($where)->first();

				if ($first) {
					errorone('品牌名称已存在!');
				}

				$data = [

						'brand_log' => $file,
						'brand_name' => $brand_name,
						'brand_url' => $brand_url,
						'brand_show' => $brand_show,
						'add_time' => time()

				];
			}
			$wheres=[
					['brand_id','=',$brand_id]
			];
			$brand = BrandModel::where($wheres)->update($data);
			if($brand!==false){
				success("修改成功");
			}else{
				error("修改失败");
			}



		}
	}
	//即点即改
	public function check(Request $request){
		$_value=$request->input('_value');
		
		$_field=$request->input('_field');
		//dd($_field);
		$_brand_id=$request->input('_brand_id');
		
	   //$obj=new Shop;
	   //$res=$obj->where("_brand_id=$_brand_id")->update([$_field=>$_value]);
	   $where=[
		   ['brand_id','=',$_brand_id]
	   ];
	   //dd($where);
	   //$res=DB::table('shop')->where($where)->update([$_field=>$_value]);
	   $res=BrandModel::where($where)->update([$_field=>$_value]);
	   //07dd($res);
	   if($res!==false){
		   echo "ok";
	   }else{
		   echo "no";
	   }
	}

	public function pishan(){
		$id=request()->user_id;
		//return $id;	die;
			
		$str = explode(",",$id);
		//dd($str);
		$ret = BrandModel::whereIn('brand_id',$str)->update(['is_del'=>2]);

		//dump(db::getLastSql());exit;

		if($ret!==false){
				return 1;

		}else{
				return 2;
		}
	}


}
