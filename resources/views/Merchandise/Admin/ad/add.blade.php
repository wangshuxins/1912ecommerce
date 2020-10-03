@extends('layouts.admin.layout')
@section('title','广告添加')
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
                                <a href="#home" data-toggle="tab">广告基本信息</a>
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
										<input type="text" class="form-control" id="ad_name"   placeholder="广告名称" value="">
									</div>
										<div class="col-md-2 title">广告地址</div>
									<div class="col-md-10 data">
										<input type="text" class="form-control"  id="ad_url"  placeholder="广告地址" value="">
									</div>

	<!-- 								<div class="col-md-2 title">商品价格</div>
									<div class="col-md-10 data">
										<div class="input-group">
											<span class="input-group-addon">¥</span>
											<input type="text" class="form-control" name="goods_price" placeholder="价格" value="">
										</div>
									</div>

									<div class="col-md-2 title">商品号</div>
									<div class="col-md-10 data">
										<input type="text" class="form-control" name="goods_sn"   placeholder="商品号" value="">
									</div>

											<div class="col-md-2 title">商品数量</div>
											<div class="col-md-10 data">
												<input type="text" class="form-control" name="goods_store"   placeholder="商品数量" value="">
											</div>
											<div class="col-md-2 title">奖励积分</div>
											<div class="col-md-10 data">
												<input type="text" class="form-control" name="goods_score"   placeholder="奖励积分" value="">
											</div>-->
<!-- 									<div class="col-md-2 title">商品图片</div>
									<div class="col-md-10 data">
										<input type="file" class="form-control" name="goods_img"  value="">
									</div>

									<div class="col-md-2 title">商品子图片</div>
									<div class="col-md-10 data">
										<input type="file" class="form-control" multiple name="goods_imgs[]"  value="">
									</div> -->
	<!-- 								<div class="col-md-2 title">是否展示</div>
									<div class="col-md-10 data">
										<div class="input-group">
											<input type="radio" checked name="is_show" value="1">是
											<input type="radio" name="is_show" value="2">否
										</div>
									</div>

									<div class="col-md-2 title">是否热门</div>
									<div class="col-md-10 data">
										<div class="input-group">
											<input type="radio" checked name="is_hot" value="1">是
											<input type="radio" name="is_hot" value="2">否
										</div>
									</div>

									<div class="col-md-2 title">是否上架</div>
									<div class="col-md-10 data">
										<div class="input-group">
											<input type="radio" checked name="is_up" value="1">是
											<input type="radio" name="is_up" value="2">否
										</div>
									</div> -->
									<div class="col-md-2 title editer">广告描述</div>
                                   <div class="col-md-10 data editer">
                                       <textarea class="miaoshu" id="content" ></textarea>
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
				      <a href="javascript:void(0);" id="btn_add_file" class="btn btn-primary" ng-click="setEditorValue();save()"><i class="fa fa-save"></i>保存</a>
				      <a href="{{url('/admin/ad/index')}}" class="btn btn-default" ng-click="goListPage()">返回列表</a>
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
		// alert(ad_url);
		// alert(ad_name);
		// alert(miaoshu);




		// var goods_name = $("input[name='goods_name']").val();
		// var goods_price = $("input[name='goods_price']").val();
		// var goods_sn = $("input[name='goods_sn']").val();
		// var goods_store = $("input[name='goods_store']").val();
		// var goods_score = $("input[name='goods_score']").val();
		// var cate_id = $("select[name='cate_id']").val();
		// var brand_id = $("select[name='brand_id']").val();
		// var is_show = $("input[name='is_show']:checked").val();
		// var is_hot = $("input[name='is_hot']:checked").val();
		// var is_up = $("input[name='is_up']:checked").val();
		// var is_new = $("input[name='is_new']:checked").val();

		// var formData = new FormData($("#fileForm")[0]);
		// formData.append("goods_name",goods_name);
		// formData.append("goods_price", goods_price);
		// formData.append("goods_sn", goods_sn);
		// formData.append("goods_store", goods_store);
		// formData.append("goods_score", goods_score);
		// formData.append("cate_id", cate_id);
		// formData.append("brand_id", brand_id);
		// formData.append("is_show", is_show);
		// formData.append("is_hot", is_hot);
		// formData.append("is_up", is_up);
		// formData.append("is_new", is_new);
		// formData.append("contents",content);
		// $.ajax({
		// 	url : "{{url('/admin/goodsedit')}}",
		// 	type: 'POST',
		// 	data: formData,
		// 	async: false,
		// 	cache: false,
		// 	dataType:'json',
		// 	contentType: false,
		// 	processData: false,
		// 	success : function(data) {
		// 		if(data.error_no==0){
		// 			alert(data.error_msg);
		// 			location.href="{{url('/admin/goods')}}";
		// 		}else if(data.error_no==1){
		// 			alert(data.error_msg);
		// 		}else if(data.error_no==3){
		// 			alert(data.error_msg);
		// 		}else if(data.error_no==4){
		// 			alert(data.error_msg);
		// 		}else{
		// 			alert(data.error_msg);
		// 		}
		// 	}
		// });
		$.ajax({
			url:"{{url('admin/ad/add')}}",
			data:{ad_url:ad_url,ad_name:ad_name,ad_desc:ad_desc},
			type:"post",
			success:function(res){
				if(res==1){
					alert("添加广告成功");
					location.href="{{url('admin/ad/index')}}";
				}else{
					alert("添加广告失败");
					console.log(res);
				}
			}
		
		});



	});
</script>








@endsection