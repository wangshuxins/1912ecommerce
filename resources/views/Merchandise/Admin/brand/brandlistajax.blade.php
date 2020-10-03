@foreach($brand as $v)
			<tr  brand_id="{{$v->brand_id}}">
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
			</tr>
		@endforeach
		   <tr>
		     <td align="center" colspan="17">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
		</tr>