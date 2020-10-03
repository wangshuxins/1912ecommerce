@extends('layouts.admin.layout')
@section('title','管理员管理')
@section('content')
        <!-- .box-body -->

<div class="box-header with-border">
    <h3 class="box-title">角色权限展示</h3>
</div>

<div class="box-body">
    <!--工具栏-->
    <div class="pull-left">
        <div class="form-group form-inline">
            <div class="btn-group">
                <a  href="{{url('/admin/rightedit')}}" class="btn btn-default" title="新建权限" ><i class="fa fa-file-o"></i> 新建权限</a>
            </div>
        </div>
    </div>
    <!--数据列表-->
    <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="sorting_asc">权限ID</th>
            <th class="sorting_asc">角色</th>
            <th class="sorting">权限名称</th>
            <th class="sorting">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roleright as $v)
            <tr role_id="{{$v['role_id']}}" right_id="{{$v['right_id']}}">
                <td>{{$v['right_id']}}</td>
                <td>{{$v['role_name']}}</td>
                <td>{{$v['right_name']}}</td>
                <td><a id="del" href="javascript:void(0)">删除</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
</div>
<script>
$(document).on('click',"#del",function(){
       var _this = $(this);
       var role_id = _this.parents('tr').attr('role_id');
       var right_id = _this.parents('tr').attr('right_id');
       if(confirm('确定要删除吗?')){
           $.ajax({
               url:'/admin/admin/rightsdel/'+role_id,
               data:{right_id:right_id},
               dataType:'json',
               type:'post',
               success:function(res){
                   if(res.error_no==0){
                       alert(res.error_msg)
                       _this.parents('tr').remove();
                   }
               }
           })
       }
});
</script>
@endsection
