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
                                <a href="#home" data-toggle="tab">轮播图基本信息</a>                                                        
                            </li>   
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
		                           <div class="col-md-2 title">轮播图地址</div>
		                           <div class="col-md-10 data">
		                               <input type="text" class="form-control" value="" name="url"  placeholder="轮播图地址">
		                           </div>
		                           
		                           <div class="col-md-2 title">轮播图权重</div>
		                           <div class="col-md-10 data">
                                  		<input type="text" name="silde_weight" value=""  placeholder="轮播图权重">
		                           </div>
		                           
		                           <div class="col-md-2 title">是否展示</div>
		                           <div class="col-md-10 data">
		                           	   <div class="input-group">
			                          	   <input type="radio" checked name="is_show" value="1">是
                                           <input type="radio" name="is_show" value="2">否
		                           	   </div>
		                           </div>
		                           <div class="col-md-2 title">轮播图</div>
                                   <div class="col-md-10 data">
		                           	   <div class="input-group">
                                         <input type="file" name="imgs" id="lmg">
                                         <input type="hidden" name="img_path" value="" id="img_paths">
                                    
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
				      <button class="btn btn-default" ng-click="goListPage()"><a href="{{url('/admin/shufflingshow')}}">返回列表</a></button>
				  </div>
			
            </section>
<!-- 上传窗口 -->
<!-- 自定义规格窗口 -->
<!-- 正文区域 /-->
    <link rel="stylesheet" href="../js/uploadify/uploadify.css">
    <script src="../js/uploadify/jquery.uploadify.js"></script>
    <script>
	$(document).ready(function(){
		$("#lmg").uploadify({
			uploader:"/admin/shufflingsave",
			swf: "../js/uploadify/uploadify.swf",
			onUploadSuccess:function(res,data,msg){
					var imgPsth = data;
					$("#img_paths").val(imgPsth);
					var imgstr = "<img src='../"+imgPsth+"' width='200px'>";
					$("#imgs_desc").append(imgstr);

			}
		});
		$("#submit").click(function(){
			var _this = $(this);
			var url_desc = $("input[name='url']").val();
			var silde_weight = $("input[name='silde_weight']").val();
			var is_show = $("input[name='is_show']").val();
			var img_path = $("input[name='img_path']").val();
			if(url == ""||silde_weight==""||is_show==""||img_path==""){
				alert("文件不能为空");
			return false;
			}
			var	url = "/admin/shuinsert";
			$.ajax({
		 		//提交地址
				url:url,
				//提交方式
				type:"post",
				//提交数据
				data:{url_desc:url_desc,silde_weight:silde_weight,is_show:is_show,img_path:img_path},
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