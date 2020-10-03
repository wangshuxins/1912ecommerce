@foreach($category as $k=>$v)
		                                 <tr cate_id="{{$v->cate_id}}">
										      <td><input  type="checkbox" cate_id="{{$v->cate_id}}" class="icheckbox_square"></td>		
		                                      <td>{{$v->cate_id}}</td>
			                                  <td field="cate_name">
											  <span class="span_name">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</span>
											  <input type="text" class="check_name" value="{{$v->cate_name}}" style="display:none">
											 </td>
                                              <td class="changevalue" field="is_show">{{$v->is_show==1?'是':'否'}}</td>
			                                  <td class="changevalue" field="is_nav_show">{{$v->is_nav_show==1?'是':'否'}}</td>
			                                <th>
												<a class="btn btn-danger delete" cate_id="{{$v->cate_id}}">删除</a>
												<a href="{{url('/admin/categoryupdate/'.$v->cate_id)}}"class="btn btn-danger update" cate_id="{{$v->cate_id}}">修改</a>
												<!-- href="{{url('/admin/categoryupdate',$v->cate_id)}}" -->
			                              	</th>
			                              
		                                 </tr>
		                             @endforeach