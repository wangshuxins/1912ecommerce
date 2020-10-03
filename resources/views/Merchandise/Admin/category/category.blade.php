@extends('layouts.admin.layout')
@section('title','商品分类管理')
@section('content')
<!-- .box-body -->
                    <div class="box-header with-border">
                        <h3 class="box-title">分类管理</h3>
                    </div>
                    <div class="box-body">
                        <!-- 数据表格 -->
                        <div class="table-box">
                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i><a href="{{url('/admin/categoryedit')}}">新建</a></button>
                                        <button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>

							 <div class="box-tools pull-right">
                                <div class="has-feedback">
		                           <div class="col-md-10 data">
                                       <select class="form-control" name="parent_id"  id="lastname">
						               <option value="0">全部</option>
						               @foreach($category as $v)
                                              <option  value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
						               @endforeach
			                           </select>
		                           </div>                         
                                </div>        
                           
                            </div>
                            <!--工具栏/-->
									<center>
										<b><font color="red">{{session("get")}}</font></b>
									</center>
			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox"  class="icheckbox_square-blue">
			                              </th> 
										  <th>分类ID</th>
			                              <th>分类名称</th>
			                              <th>是否显示</th>
			                              <th>是否在导航栏显示</th>
			                              <th>操作</th>
                                         
			                          </tr>
			                      </thead>
			                      <tbody>
			                         @foreach($category as $k=>$v)
		                                 <tr cate_id="{{$v->cate_id}}">
										      <td><input  type="checkbox" cate_id="{{$v->cate_id}}" class="icheckbox_square"></td>		
		                                      <td>{{$v->cate_id}}</td>
			                                  <td field="cate_name">
											  <span class="span_name">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</span>
											  <input type="text" class="check_name" value="{{$v->cate_name}}" style="display:none">
											 </td>
                                              <td class="changevalue" field="is_del">{{$v->is_del==1?'是':'否'}}</td>
			                                  <td class="changevalue" field="is_nav_show">{{$v->is_nav_show==1?'是':'否'}}</td>
			                                <th>
												<a class="btn btn-danger delete" cate_id="{{$v->cate_id}}">删除</a>
												<a href="{{url('/admin/categoryupdate/'.$v->cate_id)}}"class="btn btn-danger update" cate_id="{{$v->cate_id}}">修改</a>
												<!-- href="{{url('/admin/categoryupdate',$v->cate_id)}}" -->
			                              	</th>
			                              
		                                 </tr>
		                             @endforeach
									  
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->                        
							  
							 
                        </div>
                        <!-- 数据表格 /--> 
                        
                     </div>
                    <!-- /.box-body -->

<script>
	$(function(){
		// $(".btn-default").click(function(){
		//  	var _this = $(this);
		//  	var _id = $(".icheckbox_square").val();
		//  	var name = $(":checked").attr("cate_id");
		//  	console.log(name);
		// });
		//js删除
	$(".delete").click(function(){
			var _this = $(this);
			var desc_id = _this.attr("cate_id");
			if(window.confirm("你要删除这条数据吗")){
				var url = "/admin/categorydel/"+desc_id;
				location.href=url;
			}
		});

    $(document).on('change',"#lastname",function(){
		
		  var cate_id = $("select[name='parent_id']").val();
        
		  $.ajax({
		      
			   url:"{{url('/admin/category')}}",

			   data:{cate_id:cate_id},

			   type:'get',

			   success:function(res){
			     
				$('tbody').html(res);
			   
			   }
		  })
			   $(document).on("click",'.page-item a',function(){
     //alert('1234');

      var url = $(this).attr('href');

        $.get(url,function(res){
  
         $('tbody').html(res);

       });
       return false;
     });
		return;
		});
	});
	//点击是否显示
	$(document).on('click','.changevalue',function(){
		//获取这个对象
		var _this=$(this);
		//获取id
		var cate_id=_this.parents('tr').attr('cate_id');
		//获取字段
		var field=_this.attr('field');
		//获取纯文本
		var sign=_this.text();
		if(sign=='是'){
			var _value=0;
		}else{
			var _value=1;
		}
		//ajax传值
		$.post(
			"{{url('admin/category/check')}}",
			{cate_id:cate_id,field:field,_value:_value},
			function(res){
				if(res=='ok'){
					if(sign=='是'){
						_this.text('否');
					}else{
						_this.text('是');
					}
				}
			}
		);
	})
	//即点即改
	$(document).on('click','.span_name',function(){
		//获取这个对象
		var _this=$(this);
		//点击隐藏
		_this.hide();
		//获取下一个兄弟节点  让它显示
		_this.next('input').show();

		//给input框绑定一个失去焦点事件
		$(".check_name").blur(function(){
			//获取这个对象
			var _this=$(this);
			//获取值
			var _value=_this.val();
			//获取字段
			var _field=_this.parent().attr('field');
			//获取id
			var cate_id=_this.parents('tr').attr('cate_id');
			//ajax传值
			$.post(
				"{{url('admin/category/check2')}}",
				{_value:_value,_field:_field,cate_id:cate_id},
				function(res){
					if(res=='ok'){
						_this.prev('.span_name').text(_value).show();
						_this.hide();
					}
				}
			);
		})
	})
</script>		
@endsection