@extends('layouts.admin.layout')
@section('title','修改品牌')
@section('content')
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
							<form encrype="multipart/form-data">
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
		                           <div class="col-md-2 title">品牌名称</div>
		                           <div class="col-md-10 data">
		                               <input type="text" class="form-control" name="brand_name" value="{{$brand->brand_name}}" placeholder="品牌名称" >
		                           </div>
		                           
		                           <div class="col-md-2 title">品牌url</div>
		                           <div class="col-md-10 data">
                                       <input type="text" class="form-control" name="brand_url" value="{{$brand->brand_url}}"  placeholder="商品品牌url">
		                           </div>
		
								   <div class="col-md-2 title">品牌图片</div>
		                           <div class="col-md-10 data">
		                               <input type="file" class="form-control" id="crowd_file" name="brand_log"  value="">
		                           </div>
                                    @if($brand->brand_log)
                                   <div class="col-md-2 title">原品牌图片</div>
		                           <div class="col-md-10 data">
                                   @if($brand->brand_log)
		                               <img width="50px" src="/{{$brand->brand_log}}">
                                    @endif
		                           </div>
		                           @endif
		                           <div class="col-md-2 title">是否展示</div>
		                           <div class="col-md-10 data">
		                           	   <div class="input-group">
                                          @if($brand->brand_show==1)
			                          	   <input type="radio" checked name="brand_show" value="1">是
                                           <input type="radio" name="brand_show" value="2">否
                                           @else
                                           <input type="radio" checked name="brand_show" value="1">是
                                           <input type="radio" name="brand_show" value="2">否
                                           @endif
		                           	   </div>
		                           </div> 

                                  
                            </div>
                            <div class="col-md-10 data">
                                       <input type="hidden" class="form-control" id="hidden" brand_id="{{$brand->brand_id}}"   placeholder="商品品牌url">
		                           </div>
							</form>
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
							 
                    </div>
                   </div>
                  <div class="btn-toolbar list-toolbar">
				       <a class="btn btn-default" href="javascript:void(0);" id="submit">修改</a>
				     <!-- <a class="btn btn-default" href="{{url('/admin/index')}}">返回列表</a> -->
				  </div>
			
            </section>
<!-- 上传窗口 -->
<!-- 自定义规格窗口 -->
            <!-- 正文区域 /-->
<script type="text/javascript">
	$("#submit").click(function(){
		 var brand_name = $("input[name='brand_name']").val();
         var brand_url = $("input[name='brand_url']").val();
         var crowd_file = $('#crowd_file')[0].files[0];
		 var brand_show = $("input[name='brand_show']:checked").val();
         var brand_id = $("#hidden").attr('brand_id');
	    var formData = new FormData();
        formData.append("crowd_file",crowd_file);
		formData.append("brand_name", brand_name);
		formData.append("brand_url", brand_url);
		formData.append("brand_show", brand_show);
        formData.append("brand_id", brand_id);
	    $.ajax({
        url:'/admin/brand/exitadd',
        dataType:'json',
        type:'POST',
        //async: false,
        data: formData,
        processData : false, // 使数据不做处理
        contentType : false, // 不要设置Content-Type请求头
        success: function(data){
           if(data.error_no==0){
		       alert(data.error_msg);
			   location.href="{{url('/admin/index')}}"
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