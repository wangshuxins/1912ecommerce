@extends('layouts.admin.layout')
@section('title','属性值管理')
@section('content')
        <!-- .box-body -->

<div class="box-header with-border">
    <h3 class="box-title">属性值展示</h3>
</div>

<div class="box-body">

    <!-- 数据表格 -->
    <div class="table-box">

        <!--工具栏-->
        <div class="pull-left">
            <div class="form-group form-inline">
                <div class="btn-group">
                    <a href="{{url('/admin/attrvaledit')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
                    <button type="button" class="btn btn-default" title="删除" id="delMany"><i class="fa fa-trash-o"></i> 删除</button>
                    <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                </div>
            </div>
            <form action="/admin/attrval">
                权限名称：<input type="text" name="attrval_name" value="{{$attrval_name??''}}" >
                <button id="search"  class="btn btn-default"  type="submit">查询</button>
            </form>
        </div>


    </div>
    <!--工具栏/-->


    <!--数据列表-->
    <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>

            <th class="sorting_asc">属性值ID</th>
            <th class="sorting">属性名名称</th>
            <th class="sorting">属性值名称</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attrval as $v)

            <tr  id="{{$v->id}}">
                <td>{{$v->id}}</td>
                <td>{{$v->attr_name}}</td>
                <td>{{$v->attrval_name}}</td>
                <td class="text-center">
                    <button type="button" class="btn bg-olive btn-xs del">删除</button>
                    <a href="{{url('admin/attrvalexit/'.$v->id)}}">
                        <button type="button" class="btn bg-olive btn-xs">修改</button>
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td align="center" colspan="3">{{$attrval->appends(['attrval_name'=>$attrval_name])->links()}}</td>
        </tr>
        </tbody>
    </table>
    <!--数据列表/-->


</div>
<!-- 数据表格 /-->


</div>
<!-- /.box-body -->
<script type="text/javascript">
    $(document).on("click",".del",function(){
        //获取点击的这个对象
        var _this=$(this);
        //获取删除的id
        var id=_this.parents("tr").attr('id');
        // $.post(
        // 	"{{url('attrvaldel')}}",
        // );
        if(confirm('确定要删除吗?')){
            $.ajax({
                url:"{{url('admin/attrvaldel')}}",
                type:"post",
                dataType:'json',
                data:{id:id},
                success:function(res){
                    if(res.error_no==0){
                        alert(res.error_msg);
                        _this.parent().parent().remove();
                    }else{
                        alert(res.error_msg);
                    }
                }
            })
        }
    })
</script>



@endsection
