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
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                 
							                   商品名称：<input type="text" name="goods_name">									
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
										  <th>商品ID</th>
										  <th>商品名称</th>
										  <th>商品号</th>
										  <th>商品分类</th>
										  <th>商品品牌</th>
										  <th>商品价格</th>
										  <th>商品库存</th>
										  <th>是否显示</th>
										  <th>是否新品</th>
										  <th>是否热卖</th>
										  <th>是否上架</th>
										  <th>商品图片</th>
										  <th>商品子图片</th>
										  <th>商品详情</th>
										  <th>操作</th>
			                          </tr>
			                      </thead>
			                      <tbody>
								  @foreach($goods as $v)
			                          <tr goods_id="{{$v->goods_id}}">
			                              <td><input  type="checkbox"></td>
										  <td>{{$v->goods_id}}</td>
										  <td>{{$v->goods_name}}</td>
										  <td >{{substr($v->goods_sn,0,6)}}</td>
										  <td>{{$v->cate_name}}</td>
										  <td>{{$v->brand_name}}</td>
										  <td field="goods_price">
										   <span class="span_name">{{$v->goods_price}}</span>
										   <input type="text" class="check_name" value="{{$v->goods_price}}" style="display:none">
										 </td>
										  <td field="goods_score">
										  <span class="span_name">{{$v->goods_score}}</span>
										   <input type="text" class="check_name" value="{{$v->goods_score}}" style="display:none">
										</td>
										  <td  class="changevalue" field="is_show">{{$v->is_show?'是':'否'}}</td>
										  <td class="changevalue" field="is_new">{{$v->is_new?'是':'否'}}</td>
										  <td class="changevalue" field="is_hot">{{$v->is_hot?'是':'否'}}</td>
										  <td class="changevalue" field="is_up">{{$v->is_up?'是':'否'}}</td>
										  <td>
											  @if($v->goods_img)
												  <img width="50" src="/{{$v->goods_img}}">
											  @endif
										  </td>

										  <td>
											  @if($v->goods_imgs)
												  @php $imgarr = explode(',',$v->goods_imgs);@endphp
												  @foreach($imgarr as $img)
													  <img src="/{{$img}}" width="50">
												  @endforeach
											  @endif
										  </td>

										  <td>{!! $v->goods_desc !!}</td>

		                                  <td class="text-center">
										       <a id="del" del_id="{{$v->goods_id}}" class="btn bg-olive btn-xs">删除</a>
		                                  </td><td class="text-center">
										       <a href="{{url('/admin/update/'.$v->goods_id)}}" class="btn bg-olive btn-xs">修改</a>
										   </td>
			                          </tr>
									  @endforeach
									   <tr>
										  <td align="center" colspan="17">{{$goods->appends(['goods_name'=>$goods_name])->links()}}</td>
									  </tr>
			                      </tbody>
			                  </table>
			                  <!--数据列表/-->
                        </div>
                        <!-- 数据表格 /-->
                     </div><!-- /.box-body -->	
					
<script>
     $(document).on("click","#del",function(){
	      //获取当前点击的删除按钮
	      var _this = $(this);
          //获取自定义属性id
	      var goods_id = _this.attr('del_id');
		  //ajax
		  if(confirm('确定要删除吗？')){
		    $.ajax({
		       url:"{{url('/admin/delete')}}",
			   type:'post',
			   data:{goods_id:goods_id},
			   dataType:"json",
			   success:function(res){
			     if(res.error_no==0)
			      
				  _this.parent().parent().remove();
			   }
		  })
		} 
	 })
     $(document).on('click','#submit',function(){
		
		 var goods_name=$("input[name='goods_name']").val();
		 $.ajax({
			 url:"{{url('/admin/goods/')}}",
			 type:'get',
			 data:{goods_name:goods_name},
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
	 //价格即点即改
	 $(document).on('click','.span_name',function(){
			//获取对象
			var _this=$(this);
			//点击隐藏  对象.hide
			 _this.hide();
			//获取下一个兄弟节点  点击时让文本框显示
			_this.next('input').show();
			//给input绑定一个失去焦点事件
			$('.check_name').blur(function(){
				//获取这个对象
				_this=$(this);
				//获取值
				var _value=_this.val();
				//获取字段
				var _field=_this.parent().attr('field');
				//获取id
				var _goods_id=_this.parents('tr').attr('goods_id');
				//ajax验证
				$.post(
					//地址
					"{{url('admin/goods/check')}}",
					//值
					{_value:_value,_field:_field,_goods_id:_goods_id},
					function(res){
						if(res=='ok'){
							_this.prev('.span_name').text(_value).show();
							_this.hide();
						}
					}

				);
			})
	 })
	 //点击是否显示
	 $(document).on('click','.changevalue',function(){
		 //获取这个对象
		 _this=$(this);
		 //获取id
		 var _goods_id=_this.parents('tr').attr('goods_id');
		 //获取字段
		 var _field=_this.attr('field');
		 //获取值  获取纯文本
		 var sign=_this.text();
	     if(sign=="是"){
			 var _value=0;
		 }else{
			 var _value=1;
		 }
		 //ajax传值
		 $.post(
			 "{{url('admin/goods/check2')}}",
			 {_goods_id:_goods_id,_field:_field,_value:_value},
			 //回调函数
			 function(res){
				 //console.log(res);
				 if(res=='ok'){
					 if(sign=='是'){
						 _this.text('否');
					 }else{
						 _this.text('是')
					 }
				 }
			 }

		 );
	 })


</script>
@endsection
 