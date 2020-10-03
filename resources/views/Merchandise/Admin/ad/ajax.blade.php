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
