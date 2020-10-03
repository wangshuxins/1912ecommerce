@extends('layouts.admin.layout')
@section('title','商品分类添加')
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
                            </li>   
                        </ul>
                        <!--tab头/-->
                        
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
                                   <div class="col-md-2 title">属性名</div>
                                   <div class="col-md-10 data">
                                        <input type="hidden" name="alert_id" value="{{$name['id']}}">
                                       <input type="text" class="form-control" value="{{$name['attr_name']}}" name="attr_name"  placeholder="属性名">
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!--tab内容/-->
                        <div  class="input-group" id="imgs_desc"></div>
                        <!--表单内容/-->
                    </div>
                   </div>
                  <div class="btn-toolbar list-toolbar">
                      <a class="btn btn-default" href="javascript:void(0);" id="submit">保存</a>
                      <button class="btn btn-default" ng-click="goListPage()"><a href="{{url('/admin')}}">返回列表</a></button>
                  </div>
            
            </section>
<!-- 上传窗口 -->
<!-- 自定义规格窗口 -->
<!-- 正文区域 /-->
    <script>
    $(document).ready(function(){
        $("#submit").click(function(){
            var _this = $(this);
            var attr_name = $("input[name='attr_name']").val();
            var alert_id = $("input[name='alert_id']").val();
            if(attr_name == ""){
                alert("不能为空");
                return false;
            }
            var url = "/admin/attrupdate".alert_id;
            $.ajax({
                //提交地址
                url:url,
                //提交方式
                type:"post",
                //提交数据
                data:{attr_name:attr_name},
                //是否为同步
                adync:true,
                //回调函数
                success:function(res){
                    location.href=res;
                }
            })
        });
    });
</script>
@endsection