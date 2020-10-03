@extends('layouts.admin.layout')
@section('title','品牌管理')
@section('content')
		<!-- .box-body -->

<div class="box-header with-border">
	<h3 class="box-title">品牌展示</h3>
</div>

<div class="box-body">

	<!-- 数据表格 -->
	<div class="table-box">

		<!--工具栏-->
		<div class="pull-left">
			<div class="form-group form-inline">
				<div class="btn-group">
					<a href="{{url('/admin/brand')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
					<button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
					<button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
				</div>
			</div>
		</div>
                  <div class="box-tools pull-right">
                                <div class="has-feedback">
                       
							        品牌名称：<input type="text" name="brand_name">									
									<button type="button"  id="submit">查询</button>                                              
                                </div>                             
	</div>
	<!--工具栏/-->
	<!--数据列表-->
	<table id="dataList" class="table table-bordered table-striped table-hover dataTable">
		<thead>
		<tr>
			<th class="" style="padding-right:0px">
				<input id="selall" type="checkbox" class="icheckbox_square-blue">
			</th>
			<th class="sorting_asc">品牌ID</th>
			<th class="sorting">品牌名称</th>
			<th class="sorting">品牌url</th>
			<th class="sorting">品牌图片</th>
			<th class="sorting">是否展示</th>
			<th class="text-center">操作</th>
		</tr>
		</thead>
		<tbody>
		@foreach($brand as $k=>$v)
			<tr id="{{$v->brand_id}}">
				<td><input  class="box" type="checkbox"></td>
				<td>{{$v->brand_id}}</td>
				<td field="brand_name">
					<span class="span_name1">{{$v->brand_name}}</span>
					<input type="text" class="checkname" value="{{$v->brand_name}}" style="display:none">
				</td>
				<td>{{$v->brand_url}}</td>
				<td>@if($v->brand_log)
						<img width="50" src="/{{$v->brand_log}}">
					@endif</td>
				<td>{{$v->brand_show==1?"是":"否"}}</td>
				<td class="text-center">
					<button type="button" class="btn bg-olive btn-xs del">删除</button>
				</td>

				<td class="text-center" >
					<a href="{{url('admin/brand/exit/'.$v->brand_id)}}">
						<button type="button" class="btn bg-olive btn-xs">修改</button>
					</a>
				</td>
				@if($k==0)
				<td>
				<button type="button" id="pishan"   class="btn btn-default" title="批量删除"><i class="fa fa-refresh"></i> 批量删除</button>
				</td>
				@endif
			</tr>
		@endforeach
		  <tr>
		     <td align="center" colspan="17">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
		</tr>
		</tbody>
	</table>
	<!--数据列表/-->
</div>
<!-- 数据表格 /-->
</div>
<!-- /.box-body -->
<script type="text/javascript">
	$(document).on("click",".del",function(){
		//获取点击的这个对象
		var _this=$(this);
		//获取删除的id
		var brand_id=_this.parents("tr").attr('brand_id');
		// $.post(
		// 	"{{url('brand/del')}}",
		// );
		if(confirm('确定要删除吗?')){
			$.ajax({
				url:"{{url('admin/brand/del')}}",
				type:"post",
				dataType:'json',
				data:{brand_id:brand_id},
				success:function(res){
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

	$(document).on('click','#submit',function(){
		
		 var brand_name=$("input[name='brand_name']").val();
		 $.ajax({
			 url:"{{url('/admin/index/')}}",
			 type:'get',
			 data:{brand_name:brand_name},
			 success:function(res){
				$("tbody").html(res);
			 }
		 })
		 return;
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
//即点即改
	$(document).on('click','.span_name1',function(){
		//获取对象
		var _this=$(this);
		//点击隐藏  对象.hide()
			_this.hide();
		//获取下一个兄弟节点  点击时让文本框显示
			_this.next('input').show();
		//第二部分
		//给input绑定一个失去焦点事件
		//对象.blur(function(){})
			$(".checkname").blur(function(){
				//获取这个对象
				var _this=$(this);
				//获取新值  对象.val
				var _value=_this.val();
				//console.log(_value);
				//获取字段 
				var _field=_this.parent().attr("field");
				//获取goods_id
				var _brand_id=_this.parents('tr').attr("brand_id");
				//console.log(_brand_id);
				//ajax 验证
				$.post(
					"{{url('admin/brand/check')}}",
					{'_token':"{{ csrf_token() }}",_value:_value,_field:_field,_brand_id:_brand_id},
					function(res){
						console.log(res);
						if(res=='ok'){
							_this.prev('.span_name1').text(_value).show();
							_this.hide();
						}
					}
				);
			})
				
	});
	//点击批删
	$(document).on("click","#pishan",function(){
			var  _this=$(this);
			var  _box=$(".box:checked");
			//var id=_box.parent().prop("id");
			//alert(id);
			//console.log(id);
			//var id=$(this).parent().prop("id");
			//alert(id);
			//console.log(id);
		var user_id = "";
		_box.each(function(index){

			user_id=user_id+$(this).parent().parent().prop("id")+',';

		});
	//	console.log(user_id);return false;

		user_id = user_id.substring(0,user_id.length-1);

		if(user_id == ''){

			return;

		}
		//console.log(user_id);return false;
		// //alert(admin_id);return;
		// //console.log(admin_id);return false;
		var is_del = confirm('确定要删除吗?');

			if(is_del == true){

			$.ajax({
				url:"{{url('/admin/brand/pishan')}}",
				type:'get',
				data:{user_id:user_id},
			//	dataTy: 'json',
				success:function(res){
					//concole.log(res);
					// if(res==1){
					// 	_box.each(function(index){
					// 		_box.parent().parent().remove();
					// 	});
					// }else{
					// 	alert(res);
					// }
					if(res==1){
						_box.each(function(index){
							_box.parent().parent().remove();
						});
						alert("批删成功");
					}else{
						alert("失败");
					}
				}
			});
		}








	});
	//全选反选
	$(document).on("click","#selall",function(){
			var  checkeds=$("#selall").prop("checked");
			 if(checkeds==true){
               
                $(".box").prop('checked',true);
             }else{
                
                $(".box").prop('checked',false);
             }
	});




</script>

@endsection