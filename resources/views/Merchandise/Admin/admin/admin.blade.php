@extends('layouts.admin.layout')
@section('title','新增管理员')
@section('content')
 <!-- 正文区域 -->
            <section class="content">

                <div class="box-body">

                    <!--tab页-->
                    <div class="nav-tabs-custom">

                        <!--tab头-->
                        <ul class="nav nav-tabs">                       		
                            <li class="active">
                                <a href="#home" data-toggle="tab">管理员基本信息</a>
                            </li>   
                        </ul>
                        <!--tab头/-->
						
                        <!--tab内容-->
                        <div class="tab-content">

                            <!--表单内容-->
							<form encrype="multipart/from-data">
                            <div class="tab-pane active" id="home">
                                <div class="row data-type">                                  
		                           <div class="col-md-2 title">管理员名称</div>
		                           <div class="col-md-10 data">
		                               <input type="text" class="form-control" name="user_name" placeholder="管理员名称" >
		                           </div>
		                           
		                           <div class="col-md-2 title">管理员密码</div>
		                           <div class="col-md-10 data">
                                       <input type="password" class="form-control" name="user_pwd"  placeholder="管理员密码">
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
				     <a class="btn btn-default" href="{{url('/admin/admin/index')}}">返回列表</a>
				  </div>
			
            </section>
            
            
            <!-- 正文区域 /-->
    <script type="text/javascript">
        
       $(document).on('click','#submit',function(){
           //获取值
           var user_name=$("input[name='user_name']").val();
           var user_pwd=$("input[name='user_pwd']").val();
           $.ajax({
               url:"{{url('admin/adminadd')}}",
               type:"post",
               dataType:'json',
               data:{user_name:user_name,user_pwd:user_pwd},
               success:function(res){
                   if(res.error_no==0){
                       alert(res.error_msg)
                       location.href="{{url('/admin/admin/index')}}";
                   }else if(res.error_no==1){
                        alert(res.error_msg)
                   }
               }
           })
       })
    
    </script>
    @endsection