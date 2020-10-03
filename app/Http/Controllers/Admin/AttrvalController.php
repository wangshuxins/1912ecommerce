<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AttrvalModel;
use App\Model\AttrModel;
class AttrvalController extends Controller
{
    //新增属性值
    public function attrvaledit(){
        $attr=AttrModel::where('is_del',1)->get();
        if(request()->isMethod('get')){
            return view('Merchandise.Admin.attrval.attrvaledit',compact('attr'));
        }
        if(request()->isMethod('post')){
            $attr_id=request()->attr_id;
            $attrval_name = request()->attrval_name;
            $first = AttrvalModel::where('attrval_name',$attrval_name)->first();
            if($first){
                errorone('属性值已存在!');
            }
            if(empty($attrval_name||$attr_id)){
                error("任何选项不能为空!");
            }
            $data = [
                'attrval_name'=>$attrval_name,
                'attr_id'=>$attr_id,
                'add_time'=>time()
            ];
            $attrvalModel = new AttrvalModel();
            $res = $attrvalModel::insert($data);
            if($res){
                success('添加成功');
            }
        }
    }
    //属性值展示
    public function attrval(){
        $attrval_name=request()->attrval_name;
        $where=[];
        if($attrval_name){
            $where[] = ["shop_attrval_sku.attrval_name","like","%".$attrval_name."%"];
        }
        $attrval=AttrvalModel::orderBy("shop_attrval_sku.id","desc")->select('shop_attrval_sku.*','attr_name')->where("shop_attrval_sku.is_del",1)->where($where)
                        ->join('shop_attr_sku','shop_attrval_sku.attr_id','=',"shop_attr_sku.id")
                        ->paginate(3);
        return view('Merchandise.Admin.attrval.attrval',compact('attrval','attrval_name'));
    }
    //软删除
    public function attrvaldel(){
        $id=request()->id;
        //条件
        $where=[
            ['id','=',$id]
        ];
        $attrval=AttrvalModel::where($where)->update(["is_del"=>2]);
        if($attrval){
            success('删除成功');
        }else{
            error('删除失败');
        }
    }
    //属性值编辑
    public function attrvalexit($id){;
        $attrval=AttrvalModel::where('id',$id)->first();
        $attr=AttrModel::where('is_del',1)->get();
        return view('Merchandise.Admin.attrval.attrvalexit',compact('attrval','attr'));
    }
    //属性值修改
    public function attrvalupdate(){
        if(request()->isMethod('post')){
            $id = request()->id;
            $attrval_name = request()->attrval_name;
            $attr_id = request()->attr_id;
            $where = [
                ['attrval_name','=',$attrval_name],
                ['id','<>',$id]
            ];
            $first = AttrvalModel::where($where)->first();
            if($first){
                errorone('属性值已存在!');
            }
            if(empty($attrval_name||$attr_id)){
                error("任何选项不能为空!");
            }
            $data = [
                'attrval_name'=>$attrval_name,
                'attr_id'=>$attr_id,
                'add_time'=>time()
            ];
            $attrvalModel = new AttrvalModel();
            $res = $attrvalModel::where('id',$id)->update($data);
            if($res){
                success('修改成功');
            }
        }
    }
}
