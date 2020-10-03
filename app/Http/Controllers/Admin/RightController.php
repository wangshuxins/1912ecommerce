<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\RightModel;
class RightController extends Controller
{
    //新增权限
    public function rightedit(){
        if(request()->isMethod('get')){
            return view('Merchandise.Admin.right.rightedit');
        }
        if(request()->isMethod('post')){
            $right_name = request()->right_name;
            $right_url = request()->right_url;
            $right_desc= request()->right_desc;
            $first = RightModel::where('right_name',$right_name)->first();
            if($first){
                errorone('权限名称已存在!');
            }
            if(empty($right_name)||empty($right_url)||empty($right_desc)){
                error("任何选项不能为空!");
            }
            $data = [
                'right_name'=>$right_name,
                'right_url'=>$right_url,
                'right_desc'=>$right_desc,
                'add_time'=>time()
            ];
            $rightModel = new RightModel();
            $res = $rightModel::insert($data);
            if($res){
                success('添加成功');
            }
        }
    }
    //权限展示
    public function right(){
        $right_name=request()->right_name;
        $where=[];
        if($right_name){
            $where[] = ["shop_right_rbac.right_name","like","%".$right_name."%"];
        }
        if(request()->ajax()){
            $right = RightModel::orderBy('right_id','desc')->where('is_del',1)->where($where)->paginate(5);
            return view('Merchandise.Admin.right.rightajax',compact('right','right_name'));
        }
            $right = RightModel::orderBy('right_id','desc')->where('is_del',1)->where($where)->paginate(5);
            return view('Merchandise.Admin.right.right',compact('right','right_name'));
    }
    //软删除
    public function rightdel(){
        $right_id=request()->right_id;
        //条件
        $where=[
            ['right_id','=',$right_id]
        ];
        $right=RightModel::where($where)->update(["is_del"=>2]);
        if($right){
            success('删除成功');
        }else{
            error('删除失败');
        }
    }
    //权限编辑
    public function rightexit($right_id){;
        $right=RightModel::where('right_id',$right_id)->first();
        return view('Merchandise.Admin.right.rightexit',compact('right'));
    }
    //权限修改
    public function rightupdate(){
        if(request()->isMethod('post')){
            $right_id = request()->right_id;
            $right_name = request()->right_name;
            $right_url = request()->right_url;
            $right_desc= request()->right_desc;
            $where = [
                ['right_name','=',$right_name],
                ['right_id','<>',$right_id]
            ];
            $first = RightModel::where($where)->first();
            if($first){
                errorone('权限名称已存在!');
            }
            if(empty($right_name)||empty($right_url)||empty($right_desc)){
                error("任何选项不能为空!");
            }
            $data = [
                'right_name'=>$right_name,
                'right_url'=>$right_url,
                'right_desc'=>$right_desc,
                'add_time'=>time()
            ];
            $rightModel = new RightModel();
            $res = $rightModel::where('right_id',$right_id)->update($data);
            if($res){
                success('修改成功');
            }
        }
    }
    //批量删除
    public function alldel(){

        $right_id = Request()->input('right_id');

        $str = explode(",",$right_id);

        $ret = RightModel::whereIn('right_id',$str)->update(['is_del'=>2]);
        //dump(db::getLastSql());exit;
        if($ret!==false){
            success('删除成功');
        }else{
            error('删除失败');
        }
    }
}
