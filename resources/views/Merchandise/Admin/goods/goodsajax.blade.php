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