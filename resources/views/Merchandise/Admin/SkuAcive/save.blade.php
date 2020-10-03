@extends('layouts.admin.layout')
@section('title','SKU添加')
@section('content')
 <!-- 正文区域 -->
            <section class="content">

                <div class="box-body">

                    <!--tab页-->
                    <div class="nav-tabs-custom">

                        <!--tab头-->
                        <ul class="nav nav-tabs">                               
                            <li class="active">
                                <a href="#home" data-toggle="tab">SKU属性名</a>     
                                {{session("get")}}                                                   
                            </li>   
                        </ul>
                        <!--tab头/-->
                        <div class="tab-content">
                                
                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
                                   <div class="col-md-2 title">商品名称</div>
		                           <div class="col-md-10 data">
                                       <select class="form-control" name="goods_name" id="lastname">
						               <option value="">请选择</option>
						               @foreach($goods_id as $k=>$v)
                                      <option value="{{$v['goods_id']}}">{{$v["goods_name"]}}</option>
						               @endforeach
			                           </select>
		                           </div>
                            </div>
                        </div>
                         @foreach($attr_handle_data as $k=>$v)          
                        <div class="tab-pane active" id="home">
                            <div class="row data-type">
                                <div class="col-md-2 title">
                                    {{$v["attr_name"]}}
                                </div>
                            <div class="col-md-10 data">
                            <div class="input-group">
                            @foreach($attrvalData as $kk=>$vv)
                                @if($vv["attr_id"] == $v["id"])
                                    <input type="checkbox" name="goods_val_name" id="attr_id" attr_id="{{$vv['attr_id']}}" value="{{$vv['id']}}"  class="attrval_name">{{$vv["attrval_name"]}}
                                @endif
                            @endforeach
                            </div>
                            </div>
                            </div>
                        </div> 
                         @endforeach
                        <!--tab内容/-->
                        <div  class="input-group" id="imgs_desc"></div>
                        <!--表单内容/-->
                    </div>
                   </div>
                  <div class="btn-toolbar list-toolbar">
                      <a class="btn btn-default" href="javascript:void(0);" id="submit">确认</a>
                  </div>
                <!-- ############################判断用户最后的属性值名 style="display:none;"######################################### -->
            <div class="modal-content" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">库存</button>
                    <h3 id="myModalLabel">库存添加</h3>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped"   width="800px">
                        <tr id="shop_box">
                            <td>商品</td>
                            <td>属性</td>
                            <td>库存</td>
                            <td>价格</td>
                            <td>操作</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="ti" data-dismiss="modal" aria-hidden="true">保存</button>
                    <button class="btn btn-default" id="yin" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>

                <button class="btn btn-primary" id="btn" ng-click="setEditorValue();save();"><i class="fa fa-save"></i>添加</button>
                <a href="/admin/stock/del"><button class="btn btn-default" ng-click="goListPage()">查看列表</button></a>
            </div>

                <!-- ############################判断用户最后的属性值名 style="display:none;"######################################### -->
            </section>
<!-- 上传窗口 -->
<!-- 自定义规格窗口 -->
<!-- 正文区域 /-->
<script>
    $(document).ready(function(){
        $(".list-toolbar a").click(function(){
           var _this = $(this);
           var goods_id = $("#lastname").val();
           var str="";
           var arr=[]
           $("input[name='goods_val_name']:checked").each(function() {
               if(arr.length===0){
                   arr[$(this).attr("attr_id")]=$(this).val()+","
               }else{
                   if(arr[$(this).attr("attr_id")]===undefined){
                       arr[$(this).attr("attr_id")]=$(this).val()+","
                   }else{
                       arr[$(this).attr("attr_id")]+=$(this).val()+","
                   }
               }
           });
          var date={goods_id:goods_id,ability:arr}
            var url = "/admin/stock/createDo";
            $.ajax({
                //提交地址
                url:url,
                dataType:"json",
                //提交方式
                type:"post",
                //提交数据
                data:date,
                //是否为同步
                adync:true,
                //回调函数
                success:function(res){
                    if(res.code == 200){
                        alert("确认成功");
                        var goods_name = res.msg.goods_name;
                        var html = "";
                       $.each(res.data,function(k,v){
                        html +="<tr> "+
                            "<td name='goods' goods_id="+goods_id+">"+goods_name+"</td> " +
                            "<td name= 'sx' sx_id="+v.id.slice(0,v.id.length-1)+">"+v.sku+"</td> " +
                            "<td><input type='text' name='num' id='num' value=''></td> " +
                            "<td><input type='text' name='price' id='price' value=''> </td> "+
                            "<td><input type='button' class='btn btn-primary but btn-success' value='确认' disabled> </td></tr> "
                       });
                       $("#shop_box").after(html);
                       $(".modal-content").show();
                    }else{
                        alert("添加失败");
                        return false;
                    }

                }
            })
        });
        $("#yin").click(function(){
            $(".modal-content").hide();
        });
       $(document).on("click","#ti",function () {

       })
        var num=""
        var price=""
        var all=""
        $(document).on("focus","#num",function () {//获取焦点
            $(".but").attr("disabled","false")
            $(this).parent().next().next().children().removeAttr("disabled")
        })
        $(document).on("focus","#price",function () {//获取焦点
            $(".but").attr("disabled","false")
            $(this).parent().next().children().removeAttr("disabled")
        })
        $(document).on("blur","#num",function () {
            num=$(this).val()
        })
        $(document).on("blur","#price",function () {

            price=$(this).val()
        })
        var str=""
        $(document).on("click",".but",function () {
            var ability = $(this).parent().prev().prev().prev().attr('sx_id');
            alert(num)
            if(num==="" || price===""){
                alert("操作有误")
                return
            }
            all=+num+"@"+price+"@"+ability+"|";
            str+=all
            console.log(str);return false;
            num=""
            price=""
        })
        $(document).on("click","#ti",function(){
            var data={}
            var goods_id = $("td[name='goods']").attr('goods_id');
            str =str.slice(0,str.length-1)
            data.ability=str;
            data.goods_id = goods_id;
            $.ajax({
                url:"/admin/AssocSave",
                type:'post',
                dataType:'json',
                data:data,
                success:function(msg){
                    if(msg.success == true){
                        location.href="/admin/AssocShow";
                    }else{
                      alert("添加失败，请联系管理员");
                      return false;
                    }
                }
            })
        });
       $(document).on("click","#list",function(){
           location.href="index";
       })

    });
</script>
@endsection