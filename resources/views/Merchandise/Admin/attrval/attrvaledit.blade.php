@extends('layouts.admin.layout')
@section('title','新增属性值')
@section('content')
        <!-- 正文区域 -->
<section class="content">
    <div class="box-body">
        <!--tab页-->
        <div class="nav-tabs-custom">

            <!--tab头-->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab">属性值基本信息</a>
                </li>
            </ul>
            <!--tab头/-->
            <!--tab内容-->
            <div class="tab-content">
                <!--表单内容-->
                <form encrype="multipart/from-data">
                    <div class="tab-pane active" id="home">
                        <div class="row data-type">
                            <div class="col-md-2 title">属性值名称</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control" name="attrval_name" placeholder="属性值名称" >
                            </div>
                            <div class="col-md-2 title">属性名名称</div>
                            <div class="col-md-10 data">
                                <select class="form-control" name="attr_id" >
                                    <option value=''>--请选择属性名--</option>
                                    @foreach($attr as $v)
                                        <option value='{{$v->id}}'>{{$v->attr_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
                <!--tab内容/-->
                <!--表单内容/-->
            </div>
        </div>
        <div class="btn-toolbar list-toolbar">
            <a class="btn btn-default" href="javascript:void(0);" id="submit">保存</a>
            <a class="btn btn-default" href="{{url('/admin/attrval')}}">返回列表</a>
        </div>
    </div>
</section>
<!-- 上传窗口 -->
<!-- 自定义规格窗口 -->
<!-- 正文区域 /-->
<script type="text/javascript">
    $("#submit").click(function(){
        var attrval_name = $("input[name='attrval_name']").val();
        var attr_id = $("select[name='attr_id']").val();
        var formData = new FormData();
        formData.append("attrval_name", attrval_name);
        formData.append("attr_id", attr_id);
        $.ajax({
            url:'/admin/attrvaledit',
            dataType:'json',
            type:'POST',
            //async: false,
            data: formData,
            processData : false, // 使数据不做处理
            contentType : false, // 不要设置Content-Type请求头
            success: function(data){
                if(data.error_no==0){
                    alert(data.error_msg);
                    location.href="{{url('/admin/attrval')}}"
                }else if(data.error_no==2){
                    alert(data.error_msg);
                }else{
                    alert(data.error_msg)
                }
            },
        });
    });
</script>
@endsection