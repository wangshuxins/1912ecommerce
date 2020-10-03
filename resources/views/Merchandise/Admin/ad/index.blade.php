@extends('layouts.admin.layout')
@section('title','广告管理-列表')
@section('content')

	<div class="box-header with-border">
	<h3 class="box-title">广告展示</h3>
</div>

<div class="box-body">

	<!-- 数据表格 -->
	<div class="table-box">

		<!--工具栏-->
		<div class="pull-left">
			<div class="form-group form-inline">
				<div class="btn-group">
					<a href="{{url('/admin/ad/add')}}" class="btn btn-default" title="新建新闻" ><i class="fa fa-file-o"></i> 新建</a>
					<button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
					<button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
				</div>
			</div>
			<input type="text" id="ad_name"  value="">
			<button class="submit">搜索</button>
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
			<th class="sorting_asc">广告ID</th>
			<th class="sorting">广告名称</th>
			<th class="sorting">广告url</th>
			<th class="sorting">添加时间</th>
			<th class="sorting">广告详情</th>
			<th class="text-center">操作</th>
		</tr>
		</thead>
		<tbody>

		@foreach($res as $v)
			@if($v->is_del==0)
		
			<tr  id="{{$v->ad_id}}">
				<td><input  type="checkbox"></td>
				<td>{{$v->ad_id}}</td>
				<td>{{$v->ad_name}}</td>
				<td>{{$v->ad_url}}</td>
				<td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
				<td>{{!! $v->ad_desc !!}}</td>
				<td class="text-center">
					<button type="button" class="btn bg-olive btn-xs del">删除</button>
				
					<a href="{{url('admin/ad/xiu/'.$v->ad_id)}}">
						<button type="button" class="btn bg-olive btn-xs">修改</button>
					</a>
				</td>
			</tr>
			@endif

		@endforeach
			 <tr>
				<td align="center" colspan="7">{{$res->appends(['ad_name'=>$ad_name])->links()}}</td>		
			</tr>
		</tbody>
			</table>
				
	
	<!--数据列表/-->
</div>


<script>
	$(document).ready(function(){
		$(document).on("click",".del",function(){
			var _this = $(this);
			var ad_id= _this.parents("tr").prop("id");
			//alert(ad_id);
			$.ajax({
				url:"{{url('admin/ad/shan')}}",
				data:{ad_id:ad_id},
				type:"post",
				success:function(res){
					if(res==1){
						alert("删除成功");
						_this.parents("tr").remove();
					}else{
						alert("删除失败");
					}
				}


			})
		});
		$(document).on("click",".submit",function(){
			var  ad_name=$("#ad_name").val();//搜索名称
			var _this=$(this);
			$.ajax({
				url:"{{url('admin/ad/index')}}",
				type:"post",
				data:{ad_name:ad_name},
				success:function(res){
					$("tbody").html(res);

				}
			})
                  return;
		});

         //ajax 分页
      $(document).on("click",'.page-item a',function(){
        //alert('1234');

      var url = $(this).attr('href');

        $.get(url,function(res){
  
         $('tbody').html(res);

       });
       return false;
     });

	});
</script>



@endsection