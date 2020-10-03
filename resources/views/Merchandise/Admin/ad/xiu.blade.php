@extends('layouts.admin.layout')
@section('title','广告管理-修改')
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
                                <a href="#home" data-toggle="tab">新闻基本信息</a>
                            </li>

                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">
                            <!--表单内容-->

                            <div class="tab-pane active" id="home">
								   <form enctype="multipart/form-data" id="fileForm">
                                        <div class="row data-type" >

									<div class="col-md-2 title">广告名称</div>
									<div class="col-md-10 data">
										<input type="text" class="form-control" id="ad_name" value="{{$res->ad_name}}"  placeholder="广告名称" value="">
									</div>
										<div class="col-md-2 title">广告地址</div>
									<div class="col-md-10 data">
										<input type="text" class="form-control"  id="ad_url" value="{{$res->ad_url}}" placeholder="广告地址" value="">
									</div>
									<div class="col-md-2 title editer">广告描述</div>
                                   <div class="col-md-10 data editer">
                                       <textarea class="miaoshu" id="content" >{{$res->ad_desc}}</textarea>
                                   </div>
                                </div>
									</form>
                            </div>
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
                    </div>
                 	
                   </div>
                  <div class="btn-toolbar list-toolbar">
				      <a href="javascript:void(0);" id="btn_add_file" class="btn btn-primary" ng-click="setEditorValue();save()" ids="{{$res->ad_id}}"><i class="fa fa-save"></i>保存</a>
				      <a href="{{url('/admin/goods')}}" class="btn btn-default" ng-click="goListPage()">返回列表</a>
				  </div>
            </section>

            <!-- 正文区域 /-->
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
	<script type="text/javascript">
	$("#btn_add_file").on("click",function(){
		var ad_url=$("#ad_url").val();
		var ad_name=$("#ad_name").val();
//		var miaoshu=$(".miaoshu").text();
        var ad_desc = UE.getEditor('content').getContent();
        var id=$(this).attr("ids");
      
		$.ajax({
			url:"{{url('admin/ad/xiu')}}",
			data:{id:id,ad_url:ad_url,ad_name:ad_name,ad_desc:ad_desc},
			type:"post",
			success:function(res){
				if(res==1){
					alert("修改广告成功");
					location.href="{{url('admin/ad/index')}}";
				}else{
					alert("修改广告失败");
					console.log(res);
				}
			}
		
		});



	});
</script>








@endsection