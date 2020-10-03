@foreach($right as $v)

    <tr  right_id="{{$v->right_id}}" right_name="{{$v->right_name}}">
        <td><input class="box" type="checkbox"></td>
        <td>{{$v->right_id}}</td>
        <td>{{$v->right_name}}</td>
        <td>{{$v->right_url}}</td>
        <td>{!!$v->right_desc!!}</td>

        <td class="text-center">
            <button type="button" class="btn bg-olive btn-xs del">删除</button>
            <a href="{{url('admin/rightexit/'.$v->right_id)}}">
                <button type="button" class="btn bg-olive btn-xs">修改</button>
            </a>
        </td>
    </tr>
@endforeach
<tr>
    <td align="center" colspan="5">{{$right->appends(['right_name'=>$right_name])->links()}}</td>
</tr>