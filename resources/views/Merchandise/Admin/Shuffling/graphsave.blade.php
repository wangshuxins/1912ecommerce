@extends('layouts.admin.layout')
@section('title','商品管理')
@section('content')
<!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">商品管理</h3>
                    </div>
                    <div class="box-body">
                        <!-- 数据表格 -->
                        <div class="table-box">
                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <a  href="{{url('/admin/goodsedit')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
                                        <button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                  <!--           <div class="box-tools pull-right">
                                <div class="has-feedback">
                                  状态：<select>
                                         	<option value="">全部</option>      
                                         	<option value="0">未申请</option>    
                                         	<option value="1">申请中</option>    
                                         	<option value="2">审核通过</option>    
                                         	<option value="3">已驳回</option>                                     
                                        </select>
							         商品名称：<input type="text" name="goo" value="">									
									<button class="btn btn-default" id="graphery" >查询</button>                                    
                                </div>
                            </div> -->
                            <!--工具栏/-->
									
			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>

			                          <tr>
			                              <th class="" style="padding-right:0px">
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th>
										  <th>轮播图ID</th>
										  <th>轮播图地址</th>
										  <th>轮播图权重</th>
										  <th>是否展示</th>
										  <th>轮播图</th>
										  <th>轮播图添加时间</th>
										  <th>操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								  @foreach($Slide as $v)
			                          <tr>
			                              <td><input  type="checkbox"></td>
										  <td>{{$v->slide_id}}</td>
										  <td>{{$v->url}}</td>
										  <td>{{$v->slide_weight > 1?"贵":"便宜"}}</td>
										  <td>{{$v->is_show==1?'是':'否'}}</td>
										  <td>
										  	<img src="../{{$v->img_path}}" width="200px">
										  </td>
										  <td>{{date("Y-m-s H:i:s",$v->add_time)}}</td>
							
		                                  <td class="text-center">
		                          
										       <a id="del" slide_id="{{$v->slide_id}}" class="btn bg-olive btn-xs">删除</a>
		                                  </td><td class="text-center">
										       <a href="{{url('/admin/shufflingupdate/'.$v->slide_id)}}" class="btn bg-olive btn-xs">修改</a>
										   </td>
			                          </tr>
									  @endforeach
			                      </tbody>
								  <tr>
			                      <td colspan="9" align="center">{{$Slide->links()}}</td>
								  </tr>
			                  </table>
			                  <!--数据列表/-->
			              	
                        </div>
                        <!-- 数据表格 /-->
                     </div><!-- /.box-body -->
<script>
	$(function(){
		//js删除
		$("#del").click(function(){
			var _this = $(this);
			var slide_id = _this.attr("slide_id");
			if(window.confirm("你要删除这条数据吗")){
				var url = "/admin/shufflingdel/"+slide_id;
				location.href=url;
			}
		});
		//ajax分页
		$(document).on("click",".page-item a",function(){
			var desc_url = $(this).attr("href");
			$.get(desc_url,function(index){
				$("table").html(index);
			});
			return false;
		});
	});
</script>
@endsection
 
