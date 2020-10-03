@extends('layouts.admin.layout')
@section('title','新增权限')
@section('content')
    <link rel="stylesheet" href="/admin/static/plugins/kindeditor/themes/default/default.css" />
    <script type="text/javascript" charset="utf-8" src="/uploaded/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/uploaded/ueditor.all.js"></script>
        <!-- 正文区域 -->
<section class="content">

    <div class="box-body">

        <!--tab页-->
        <div class="nav-tabs-custom">

            <!--tab头-->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab">权限基本信息</a>
                </li>
            </ul>
            <!--tab头/-->

            <!--tab内容-->
            <div class="tab-content">

                <!--表单内容-->
                <form encrype="multipart/from-data">
                    <div class="tab-pane active" id="home">
                        <div class="row data-type">
                            <div class="col-md-2 title">权限名称</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control" name="right_name" placeholder="权限名称" >
                            </div>

                            <div class="col-md-2 title">权限url</div>
                            <div class="col-md-10 data">
                                <input type="text" class="form-control" name="right_url"  placeholder="权限url">
                            </div>
                            <div class="col-md-2 title editer">权限描述</div>
                            <div class="col-md-10 data editer">
                                <textarea name="right_desc" id="content" ></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--tab内容/-->
            <!--表单内容/-->

        </div>
    </div>
    <div class="btn-toolbar list-toolbar">
        <a class="btn btn-default" href="javascript:void(0);" id="submit">保存</a>
        <a class="btn btn-default" href="{{url('/admin/right')}}">返回列表</a>
    </div>

</section>


<!-- 上传窗口 -->




<!-- 自定义规格窗口 -->

<script type="text/javascript" charset="utf-8">//初始化编辑器
    window.UEDITOR_HOME_URL = "/ueditor/";//配置路径设定为UEditor所放的位置
    window.onload=function(){
        window.UEDITOR_CONFIG.initialFrameHeight=300;//编辑器的高度
        window.UEDITOR_CONFIG.initialFrameWidth=750;//编辑器的宽度
        var editor = new UE.ui.Editor({
            imageUrl : '',
            fileUrl : '',
            imagePath : '',
            filePath : '',
            imageManagerUrl:'', //图片在线管理的处理地址
            imageManagerPath:'__ROOT__/'
        });
        editor.render("content");//此处的EditorId与<textarea name="content" id="EditorId">的id值对应 </textarea>

    }
</script>
<!-- 正文区域 /-->
<script type="text/javascript">

    $("#submit").click(function(){

        var right_name = $("input[name='right_name']").val();
        var right_url = $("input[name='right_url']").val();
        var right_desc = UE.getEditor('content').getContent();
        var formData = new FormData();
        formData.append("right_name",right_name);
        formData.append("right_url", right_url);
        formData.append("right_desc", right_desc);
        $.ajax({
            url:'/admin/rightedit',
            dataType:'json',
            type:'POST',
            //async: false,
            data: formData,
            processData : false, // 使数据不做处理
            contentType : false, // 不要设置Content-Type请求头
            success: function(data){
                if(data.error_no==0){
                    alert(data.error_msg);
                    location.href="{{url('/admin/right')}}"
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