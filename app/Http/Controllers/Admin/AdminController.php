<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\UserRoleModel;
class AdminController extends Controller
{
    public function index(){
        $user_name=request()->user_name;
        $where=[];
        if(!empty($user_name)){
            $where[]=['user_name','like',"%$user_name%"];
        }
        $admin=AdminModel::where('is_del',1)->where($where)->paginate(2);
        if(request()->ajax()){
            return view('Merchandise.Admin.admin.indexajax',['admin'=>$admin,'user_name'=>$user_name]);
        }
        return view('Merchandise.Admin.admin.index',['admin'=>$admin,'user_name'=>$user_name]);
    }
    public function create(){
        return view('Merchandise.Admin.admin.admin');
    }
    public function adminadd(){
        $user_name=request()->user_name;
        $user_pwd=request()->user_pwd;
        $user_time=time();
        $data=[
            'user_name'=>$user_name,
            'user_pwd'=>encrypt($user_pwd),
            'user_time'=>time()
        ];
        $where=[
            ['user_name','=',$user_name]
        ];
        $res=AdminModel::where($where)->first();
        if($res){
            error('管理员名称以存在');
        }
        $admin=AdminModel::insert($data);
        if($admin){
            success('添加成功');
        } 
    }
    //软删除
    public function del(){
       $user_id=request()->user_id;
       $where=[
           ['user_id','=',$user_id]
       ];
       $admin=AdminModel::where($where)->update(['is_del'=>2]);
       if($admin){
           success('删除成功');
       }
    }
    //修改
    public function exit($id){
        $admin=AdminModel::where('user_id',$id)->first();
        return view('Merchandise.Admin.admin.exitad',['admin'=>$admin]);
    }
    public function exitad(){
        $user_name=request()->user_name;
        $user_pwd=request()->user_pwd;
        $user_id=request()->user_id;

        $where=[
            ['user_id','<>',$user_id],
            ['user_name','=',$user_name]
        ];
        $res=AdminModel::where($where)->first();
        if($res){
            error('管理员名称以存在');
        }

        $data=[
            'user_name'=>$user_name,
            'user_pwd'=>encrypt($user_pwd),
            'user_time'=>time()

        ];

        $admin=AdminModel::where('user_id',$user_id)->update($data);
        if($admin!==false){
            success('修改成功');
        }
    }
    //批量删除
    public function alldel(){

		$user_id = Request()->input('user_id');

		$str = explode(",",$user_id);

		$ret = AdminModel::whereIn('user_id',$str)->update(['is_del'=>2]);

		//dump(db::getLastSql());exit;

		if($ret!==false){

			success('删除成功');

		}else{

			error('删除失败');
		}
	}
    //角色添加
    public function roles($id){
        if(request()->isMethod('get')){

            $role = RoleModel::select('role_id','role_name')->where('is_del',1)->get();
            return view('Merchandise.Admin.admin.roles',compact('role','id'));
        }
        if(request()->isMethod('post')){
            $user_id = request()->user_id;
            $where = [
                ['user_id','=',$user_id],

            ];

            $first = UserRoleModel::where($where)->first();
            if($first){
                $role_id = UserRoleModel::select('role_id')->where($where)->first()->toArray();
                if(in_array($id,$role_id,true)){
                    errorone('此用户已经拥有此条角色');
                }

                $ids = (implode(',',$role_id));
                $idx = $id.','.$ids;
                $idz = (array_unique(explode(',',$idx)));
                $idw = implode(',',$idz);

               $up= UserRoleModel::where($where)->update(['role_id'=>rtrim($idw,',')]);
                if($up!==false){
                  success('添加角色成功');
                }
            }else{
                $userrole = new UserRoleModel();
                $data = [
                    'user_id'=>$user_id,
                    'role_id'=>$id,
                ];
                $add = $userrole->insert($data);
                if($add){
                    success('添加角色成功');
                }
            }

        }
    }
}
