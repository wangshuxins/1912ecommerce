@extends('layouts.admin.layout')
@section('title','新增商品')
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
                        <a href="#home" data-toggle="tab">商品基本信息</a>
                    </li>
                </ul>
                <!--tab头/-->

                <!--tab内容-->
                <div class="tab-content">
                    <!--表单内容-->
                    <form encrype="multipart/from-data">
                        <div class="tab-pane active" id="home">
                            <div class="row data-type">
                                <div class="col-md-2 title">角色名称</div>
                                <div class="col-md-10 data">
                                    <input type="text" class="form-control" name="role_name" value="{{$role->role_name}}" placeholder="角色名称" >
                                </div>
                                <div class="col-md-2 title editer">角色描述</div>
                                <div class="col-md-10 data editer">
                                    <textarea class="miaoshu" id="content" >{{$role->role_desc}}</textarea>
                                </div>

                            </div>
                            <div class="col-md-10 data">
                                <input type="hidden" class="form-control" name="role_id" value="{{$role->role_id}}" placeholder="角色名称" >
                            </div>
                        </div>
                    </form>
                </div>
                <!--tab内容/-->
                <!--表单内容/-->
            </div>
        </div>
        <div class="btn-toolbar list-toolbar">
            <a class="btn btn-default" href="javascript:void(0);" id="submit">修改</a>
            <a class="btn btn-default" href="{{url('/admin/index')}}">返回列表</a>
        </div>
    </section>
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
    <script>
        $(document).on("click","#submit",function(){

            var role_desc = UE.getEditor('content').getContent();

            var role_name = $("input[name='role_name']").val();

            var role_id = $("input[name='role_id']").val();

            $.ajax({

                url:'/admin/roleupdate/'+role_id,
                data:{role_name:role_name,role_desc:role_desc},
                type:"post",
                dataType:'json',
                success:function(res){
                    if(res.error_no==0){
                        alert(res.error_msg);
                        location.href="{{url('/admin/role')}}"
                    }else if(res.error_no==1){
                        alert(res.error_msg);
                    }else{
                        alert(res.error_msg);
                    }
                }
            })
        })
    </script>
@endsection