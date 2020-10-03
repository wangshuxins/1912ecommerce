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
                                <a href="#home" data-toggle="tab">商品基本信息</a>                                                        
                            </li>   
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
		                           <div class="col-md-2 title">分类名称</div>
		                           <div class="col-md-10 data">
		                           		<input type="hidden" name="cate_id" value="{{$name->cate_id}}">
		                               <input type="text" class="form-control"  name="cate_name"  placeholder="商品名称" value="{{$name->cate_name}}">
		                           </div>
		                           
		                           <div class="col-md-2 title">父级分类</div>
		                           <div class="col-md-10 data">
                                       <select class="form-control" name="parent_id" id="lastname">
						               <option value="">请选择</option>
									    <option value="0">顶级分类</option>
						               @foreach($category as $v)
                                      <option value="{{$v->cate_id}}" @if($name->parent_id == $v->cate_id) selected @endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
						               @endforeach
			                           </select>
		                           </div>
		                           
		                           <div class="col-md-2 title">是否显示</div>
		                           <div class="col-md-10 data">
		                           	   <div class="input-group">
			                          	   <input type="radio" name="is_show" value="1" @if($name->is_show == 1) checked @endif>是
                                           <input type="radio" name="is_show" value="2" @if($name->is_show == 2) checked @endif>否
		                           	   </div>
		                           </div>
		                           <div class="col-md-2 title">是否在导航栏展示</div>
                                   <div class="col-md-10 data">
		                           	   <div class="input-group">
                                         <input type="radio" name="is_nav_show" value="1"  @if($name->is_nav_show == 1) checked @endif>是
                                           <input type="radio" name="is_nav_show" value="2"  @if($name->is_nav_show == 2) checked @endif>否
                                   </div>
		                        
                                </div>
                            </div>
                        </div>
                        <!--tab内容/-->
						<!--表单内容/-->
                    </div>
           		  </div>
                  <div class="btn-toolbar list-toolbar">
					  <a class="btn btn-default" href="javascript:void(0);" id="submit">保存</a>
				      <button class="btn btn-default" ng-click="goListPage()"><a href="{{url('/admin/category')}}">返回列表</a></button>
				  </div>
			
            </section>
<script type="text/javascript">
	    $("#submit").click(function(){
		  
		  var cate_name = $("input[name='cate_name']").val();

		  var parent_id = $("select[name='parent_id']").val();

		  var is_show = $("input[name='is_show']:checked").val();

		  var is_nav_show = $("input[name='is_nav_show']:checked").val();
		  var cate_id = $("input[name='cate_id']").val();
		  var url = "/admin/categoryupdate/".cate_id;
		   $.ajax({
		       url:url,
			   type:'post',
			   dataType:'json',
			   data:{cate_name:cate_name,parent_id:parent_id,is_show:is_show,is_nav_show:is_nav_show},
			   success:function(res){
			       if(res.error_no==0){
				       alert(res.error_msg)
					  
					   location.href="{{url('/admin/category')}}";

				   }else if(res.error_no==1){
					  alert(res.error_msg)
				   }else{
					  alert(res.error_msg)
					  }
			   }
		   })
		});
</script>	
@endsection