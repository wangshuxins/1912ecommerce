@foreach($role as $v)
    <tr role_id="{{$v->role_id}}" role_name="{{$v->role_name}}">
        <td><input class="box" type="checkbox"></td>
        <td>{{$v->role_id}}</td>
        <td>{{$v->role_name}}</td>
        <td>{!! $v->role_desc !!}</td>
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td class="text-center">
            <button type="button" class="btn bg-olive btn-xs del" role_id="{{$v->role_id}}">删除</button>
            <a href="{{url('/admin/roleupdate/'.$v->role_id)}}">
                <button type="button" class="btn bg-olive btn-xs">修改</button>
            </a>
        </td>

    </tr>
@endforeach
<tr>
    <td align="center" colspan="6">{{$role->appends(['$role_name'=>$role_name])->links()}}</td>
</tr>