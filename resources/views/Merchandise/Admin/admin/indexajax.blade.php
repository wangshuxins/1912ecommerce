@foreach($admin as $v)

	<tr user_id="{{$v->user_id}}">
		<td><input  type="checkbox" class="box"></td>
		<td>{{$v->user_id}}</td>
		<td>{{$v->user_name}}</td>
		<td>{{date('Y-m-d H:i:s',$v->user_time)}}</td>
		<td class="text-center">
			<button type="button" class="btn bg-olive btn-xs del" user_id="{{$v->user_id}}">删除</button>
			<a href="{{url('admin/admin/exit/'.$v->user_id)}}">
				<button type="button" class="btn bg-olive btn-xs">修改</button>
			</a>
			<a href="{{url('admin/admin/roles/'.$v->user_id)}}">
				<button type="button" class="btn bg-olive btn-xs">添加角色</button>
			</a>
		</td>

	</tr>
@endforeach
<tr>
	<td align="center" colspan="17">{{$admin->links()}}</td>
</tr>