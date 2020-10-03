<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//SKU关联表
use App\Model\AttrSkuModel;
//商品
use App\Model\GoodsModel;
//属性值
use App\Model\AttrvalModel;
//属性名
use App\Model\AttrModel;
class SkuPropAssController extends Controller
{
    //添加
    public function AssocSave(){
    	//判断
    	if(Request()->isMethod("get")){
    		$goods_id = GoodsModel::where("is_del","1")->get()->toArray();
            $attrvalData = AttrvalModel::where("is_del","1")->get()->toArray();
            $attr_handle_data = AttrModel::where("is_del","1")->get()->toArray();
    		return view("Merchandise.Admin.SkuAcive.save",compact("goods_id","attr_handle_data","attrvalData"));
    	}
    	//判断
    	if(Request()->isMethod("post")){
            $name_desc = request()->post();
            $goods_id = $name_desc["goods_id"];
            $sku = $name_desc["ability"];
            $data = explode('|',$sku);
            $form = [];
            foreach($data as $k=>$v){
                $form[] = explode('@',$v);
            }
            $str = "";
            foreach($form as $k=>$v){
                $res = [
                    ['goods_id','=',$goods_id],
                    ['sku','=',$v[2]],
                    ['is_del','=',1]
                ];
               $arr = AttrSkuModel::where($res)->first();
                if($arr){
                    $dat = [
                        'goods_store'=>$arr['goods_store']+$v[1],
                        'goods_price'=>$v[0],
                        'add_time'=>time()
                    ];
                    $str = AttrSkuModel::where('id',$arr['id'])->update($dat);
                }else{
                    $msg = [
                        'goods_id'=>$goods_id,
                        'sku'=>$v[2],
                        'goods_store'=>$v[1],
                        'goods_price'=>$v[0],
                        'add_time'=>time()
                    ];
                    $str = AttrSkuModel::insert($msg);
                }

            }
            if($str){
                $dat = [
                    'success'=>true,
                    'msg'=>'商品属性SKU添加成功',
                    'data'=>[]
                ];
            }else{
                $dat = [
                    'success'=>false,
                    'msg'=>'商品属性SKU添加失败',
                    'data'=>[]
                ];
            }
            return json_encode($dat,true);
    	}  
    }
    //处理用户添加数据
    public function AssoccreateDo(){
        //接值
        $name = request()->post();
        //查询商品的名称
        $goods_name = GoodsModel::where("goods_id",$name["goods_id"])->first("goods_name");
        $MDKsub = $this->AssocButeSku($name);
        ajax($goods_name,$MDKsub);
    }
    //处理方法
    public function loop($arr){
        $arr1 = array();
        $sku = array_shift($arr);
        while($arr2 = array_shift($arr)){
            $arr1 = $sku;
            $sku  = array();
            foreach($arr1 as $k=>$v){
                foreach($arr2 as $k2=>$v2){
                    $sku[] = $v.','.$v2;
                }
            }
        }
        return $sku;
    }
    //u好几顿饭
    private function attrvalData($arr){
        $attr_name = AttrModel::join("shop_attrval_sku","shop_attr_sku.id","=","shop_attrval_sku.attr_id")->get()->toArray();
            $attr_handle_data = $this->array_unique_data($attr_name);
            // dd($attr_handle_data);
            $attrval_name=AttrvalModel::get()->toArray();
            $attrvalData = $this->attrvalData($attrval_name);
            foreach ($attrvalData as $key => $value) {
                  unset($attrvalData[0]);
            }
            // dd($attrvalData);
        $attrvalData=$attrval=[];
        foreach ($arr as $key => $val) {
            $attrval[$val["attrval_name"]]=$val;
        } 
        foreach($arr as $val){
        $attrvalData[$val['id']] = $val;
       }
       dd($attrvalData);
        return $attrvalData;
    }
    //展示
    public function AssocShow(){
        // $name = AttrSkuModel::where("is_del","1")->get()->toArray();
        // $data = AttrModel::leftjoin('shop_goods','shop_goods.goods_id','=','shop_goods_attrval.goods_id')->where('shop_goods_attrval.is_del',1)->paginate(7);
        $data = AttrSkuModel::leftjoin("shop_goods","shop_goods.goods_id","=","shop_attr_attrval_sku.goods_id")
                            ->where("shop_attr_attrval_sku.is_del","1")
                            ->get()->toArray();
        $form = [];
        foreach($data as $k=>$a){
            $str = "";
            $form = explode(':',$a['sku']);
            foreach($form as $k1=>$v1){
                //获取属性名
                $sx = strstr($v1,',',true);
                $where1 = [
                    ['id','=',$sx],
                    ['is_del','=',1]
                ];
                $sx = AttrModel::where($where1)->value('attr_name');
                // dump($v1);
                $sxz = strstr($v1,',');
                // dump($sxz);
                $sxz = ltrim($sxz,',');
                // dd($sxz);
                $where2 = [
                    ['attr_id','=',$sxz],
                    ['is_del','=',1]
                ];
                $sxz = AttrvalModel::where($where2)->value('attrval_name');
                $str.=$sx.':'.$sxz.'--';
            }
            $data[$k]['data'] = $str;
        }                   
        return view("Merchandise.Admin.SkuAcive.show",compact("data"));
    }

    //删除
    public function AssocDelete($id){
        $name = AttrSkuModel::where("id",$id)->update(["is_del"=>"2"]);
        if($name){
            return redirect("/admin/AssocShow");
        }else{
            return redirect("/admin/AssocShow")->with("get","删除失败，请联系管理员！");
        }
    }

    //修改
    public function AssocUpdate(){
    	if(Request()->isMethod("get")){
            dd("还没做，请稍后再试！");
    	}
    	if(Request()->isMethod("post")){
            dd("不用想太多");
    	}
    }
    //处理添加
    private function AssocButeSku($name){
        $arr = [];
        foreach(array_filter($name["ability"]) as $k=>$v){
            //去除右边的逗号转成字符串
            $dat = rtrim($v,',');
            //将字符串分割成数组
            $form = explode(',',$dat);
            //将下标作为数组的下标进行赋值
            $arr[$k] = $form;
        }
        $data = [];
        foreach($arr as $key=>$value){
            $tmp=[];
            foreach($value as $k1 => $v1){
                $str = "$key:$v1";
                array_push($tmp,$str);
            }
            array_push($data,$tmp);
        }
        $name_desc = [];
        foreach($this->loop($data) as $k=>$a){
            $dat = explode(",",$a);
            $arr1 = [];
            $str = "";
            $id = "";
            foreach($dat as $k2=>$v2){
                $sxz = strstr($v2, ':');
                $sxzs = ltrim($sxz, ":");
                $sx = strstr($v2, ":", true);
                //获取属性id
                $id .= $sx.",".$sxzs.":";
                $arr1['id'] = $id;
                 // dd($sx);
                //获取值_id
                //获取属性
                $data = AttrModel::where('id', $sx)->value('attr_name');
                //获取值
                $dat = AttrvalModel::where('attr_id', $sxzs)->value('attrval_name');
                //属性和属性值拼接
                $str .= $data.'-'.$dat.":";
                $str = rtrim($str,":");
                $arr1['sku'] = $str;
            }
            $name_desc[]=$arr1; 
        }   
        return $name_desc;
    }


}
