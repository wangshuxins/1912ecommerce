@extends('layouts.admin.layout')
@section('title','管理员管理')
@section('content')
		<!-- .box-body -->

<div class="box-header with-border">
	<h3 class="box-title">管理员展示</h3>
</div>

<div class="box-body">

	<!-- 数据表格 -->
	<div class="table-box">

		<!--工具栏-->
		<div class="pull-left">
			<div class="form-group form-inline">
				<div class="btn-group">
					<a href="{{url('/admin/create')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
					<button type="button" class="btn btn-default" title="删除" id="delMany"><i class="fa fa-trash-o"></i> 删除</button>
					<button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
				</div>
			</div>
			管理员名称：<input type="text" name="user_name" >
					 <button type="button" id="search">查询</button>
		</div>
		

	</div>
	<!--工具栏/-->
	

	<!--数据列表-->
	<table id="dataList" class="table table-bordered table-striped table-hover dataTable">
		<thead>
		<tr>
			<th class="" style="padding-right:0px">
				<input id="allbox" type="checkbox" class="icheckbox_square-blue ">
			</th>
			<th class="sorting_asc">管理员ID</th>
			<th class="sorting">管理员名称</th>
            <th class="sorting">添加时间</th>
			<th class="text-center">操作</th>
		</tr>
		</thead>
		<tbody>
		@foreach($admin as $v)

			<tr user_id="{{$v->user_id}}">
				<td><input  type="checkbox" class="box"></td>
				<td>{{$v->user_id}}</td>
				<td>{{$v->user_name}}</td>
				<td>{{date('Y-m-d H:i:s',$v->user_time)}}</td>
				<td class="text-center">
					<button type="button" class="btn bg-olive btn-xs del" user_id="{{$v->user_id}}">删除</button>
                    <a href="{{url('admin/admin/exit/'.$v->user_id)}}">
						<button type="button" class="btn bg-olive btn-xs">修改</button>
					</a>
					<a href="{{url('admin/admin/roles/'.$v->user_id)}}">
						<button type="button" class="btn bg-olive btn-xs">添加角色</button>
					</a>
				</td>
				
			</tr>
		@endforeach
		<tr>
			<td align="center" colspan="17">{{$admin->links()}}</td>
		</tr>
			
		</tbody>
	</table>
    </div>
</div>
<script>
//删除
    $(document).on('click','.del',function(){
        //获取点击的这个对象
        var _this=$(this);
        //点击获取用户id
        var user_id=_this.attr('user_id');
		if(confirm('确定要删除吗？')){
        $.ajax({
               url:"{{url('/admin/admin/del')}}",
               type:"post",
               dataType:'json',
               data:{user_id:user_id},
               success:function(res){
                   //alert(res);
                   if(res.error_no==0){
						alert(res.error_msg);
						_this.parent().parent().remove();
					}else{
						alert(res.error_msg);
					}
               }
               
           })
	     }
    })
//搜素
	$(document).on('click','#search',function(){
		//获取值
		var user_name=$("input[name='user_name']").val();
		$.ajax({
			url:"{{url('admin/admin/index')}}",
			type:"post",
			data:{user_name:user_name},
			success:function(res){
				$("tbody").html(res);
			}
		})
	})
//ajax 分页
	$(document).on("click",'.page-item a',function(){
     //alert('1234');

      var url = $(this).attr('href');

        $.get(url,function(res){
  
         $('tbody').html(res);

       });
       return false;
     });



	 //复选框
	 $(document).on("click",".box",function(){

		//alert('4');

		var _this = $(this);

		var status = _this.prop('checked');

		if(status == true){

			_this.parents('tr').css('background-color','orange');

		}else{

			_this.parents('tr').css('background-color','');

		}

	});
//点击全选
	$(document).on("click","#allbox",function(){
            var _this=$(this);
			//alert(_this);
            var status=$("#allbox").prop('checked');
			
             if(status==true){
               
                $(".box").prop('checked',true);
             }else{
                
                $(".box").prop('checked',false);
             }
            //console.log(123);
    })
//删除选中的商品
	$(document).on("click","#delMany",function(){
		var _this = $(this);
		//alert('7');4
		var _box = $(".box:checked");
		//alert(_box);return false;
		var user_id = "";
		_box.each(function(index){

			user_id=user_id+$(this).parent().parent().attr("user_id")+',';

		});
		//console.log(admin_id);return false;

		user_id = user_id.substring(0,user_id.length-1);

		if(user_id == ''){

			return;

		}

		//alert(admin_id);return;
		//console.log(admin_id);return false;
		var is_del = confirm('确定要删除吗?');

		if(is_del == true){

			$.ajax({
				url:"{{url('/admin/alldel?user_id=')}}"+user_id,
				type : 'get',
				dataTy: 'json',
				success:function(res){
					//concole.log(res);
					if(res.error_no==0){
						_box.each(function(index){
							_box.parent().parent().remove();
						});
					}else{
						alert(res.error_msg);
					}
				}
			});
		}
	});
//即点即改
	


</script>


@endsection
