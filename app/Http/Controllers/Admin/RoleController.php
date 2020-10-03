<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\RoleModel;
use App\Model\RightModel;
use App\Model\RoleRightModel;
class RoleController extends Controller
{
     public function rolecreate(){
	
	if(Request()->isMethod("get")){

	   return view("Merchandise.Admin.role.rolecreate");
	
	}

	if(Request()->isMethod("post")){
	
	    $role_name = request()->role_name;

		$role_desc = request()->role_desc;

		if(empty($role_name)||empty($role_desc)){

           error('任何选项不能为空');

		}
		$role = RoleModel::where('role_name',$role_name)->first();

		if($role){
			errorone('角色已存在!!!!');
		}

		$role = new RoleModel();

		$data = [
				'role_name'=>$role_name,
				'role_desc'=>$role_desc,
			    'add_time'=>time()

		];

		$add = $role->insert($data);

		if($add){

			success('添加成功!!!!');

		}

	}

  }
	public function role(){
		$role_name = request()->role_name;
		$where = [];

		if(!empty($role_name)){

			$where[] = ['role_name','like',"%$role_name%"];

		}


		if(request()->ajax()){
			$role = RoleModel::where('is_del',1)->where($where)->orderBy('role_id','desc')->paginate(6);
			return view('Merchandise.Admin.role.roleajax',compact('role','role_name'));
		}

		$role = RoleModel::where('is_del',1)->where($where)->orderBy('role_id','desc')->paginate(6);
		return view('Merchandise.Admin.role.role',compact('role','role_name'));

	}
	public function roledelete(){
		$role_id=request()->role_id;
		$where=[
				['role_id','=',$role_id]
		];
		$role=RoleModel::where($where)->update(['is_del'=>2]);
		if($role){
			success('删除成功');
		}
	}
	public function roleupdate($id){

		if(Request()->isMethod("get")){

			$where = [
					['role_id',"=",$id],
			];
			$role = RoleModel::where($where)->first();

			return view("Merchandise.Admin.role.roleupdate",compact('role'));

		}

		if(Request()->isMethod("post")) {

			$role_name = request()->role_name;


			$role_desc = request()->role_desc;

			if (empty($role_name) || empty($role_desc)) {

				error('任何选项不能为空');

			}
			$where = [
			     ['role_id',"<>",$id],
				 ['role_name','=',$role_name]
			];
			$role = RoleModel::where($where)->first();

			if ($role) {
				errorone('角色已存在!!!!');
			}

			$data = [
					'role_name' => $role_name,
					'role_desc' => $role_desc,
					'add_time' => time()
			];
			$update = RoleModel::where('role_id',$id)->update($data);

			if ($update!==false){

				success('修改成功!!!!');

			}
		}
	}
	//删除 批量删除
	public function alldel(){

		$role_id = Request()->input('role_id');

		$str = explode(",",$role_id);

		$ret = RoleModel::whereIn('role_id',$str)->update(['is_del'=>2]);

		//dump(db::getLastSql());exit;

		if($ret!==false){

			success('删除成功');

		}else{

			error('删除失败');
		}
	}
	//权限添加
	public function rights($id)
	{
		if (request()->isMethod('get')) {
			$right = RightModel::select('right_id', 'right_name')->where('is_del', 1)->get();
			return view('Merchandise.Admin.role.rights', compact('right', 'id'));
		}
		if (request()->isMethod('post')) {
			$role_id = request()->role_id;
			$where = [
					['role_id','=',$role_id],

			];

			$first = RoleRightModel::where($where)->first();
			if($first){
				$right_id = RoleRightModel::select('right_id')->where($where)->first()->toArray();
				if(in_array($id,$right_id,true)){
					errorone('此用户已经拥有此条角色');
				}

				$ids = (implode(',',$right_id));
				$idx = $id.','.$ids;
				$idz = (array_unique(explode(',',$idx)));
				$idw = implode(',',$idz);
				$up= RoleRightModel::where($where)->update(['right_id'=>rtrim($idw,',')]);
				if($up!==false){
					success('添加权限成功');
				}
			}else{
				$roleright = new RoleRightModel();
				$data = [
						'role_id'=>$role_id,
						'right_id'=>$id,
				];
				$add = $roleright->insert($data);

				if($add){
					success('添加权限成功2');
				}
			}
		}
	}
	//删除权限
	public function rightsdel($id){
		if (request()->isMethod('get')) {

			$roleright = RoleRightModel::select('right_id')->where('role_id',$id)->get()->toArray();
			if(empty($roleright)){
				return redirect('/admin/role')->with('msg','此角色还没有添加任何权限!');
			}
            $implode = implode($roleright[0]);
			$right_id = explode(',',$implode);
            $roleright = RightModel::select('right_id','right_name')->whereIn('right_id',$right_id)->get()->toArray();
			$role_name = RoleModel::where('role_id',$id)->first()->toArray();

			foreach($roleright as $k=>$a){
				$roleright[$k]["role_name"]=$role_name['role_name'];
				$roleright[$k]["role_id"]=$role_name['role_id'];
			}
			return view('Merchandise.Admin.role.rightsdel',compact('roleright'));
		}
		if (request()->isMethod('post')) {
			$right_id = request()->right_id;
			$roleright = RoleRightModel::select('right_id')->where('role_id',$id)->get()->toArray();
			$right_ids = implode(',',$roleright[0]);
			$array = explode(',',$right_ids);
			if(in_array($right_id,$array)){
				$aa = array_flip($array);
				unset($aa[$right_id]);
			}
			$arrays = array_flip($aa);
			$right_idx = implode(',',$arrays);
			$roleright = RoleRightModel::where('role_id',$id)->update(['right_id'=>$right_idx]);
			if($roleright!==false){
				success('删除成功');
			}
		}
	}
}
