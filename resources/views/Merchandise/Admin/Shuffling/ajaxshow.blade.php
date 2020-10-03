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