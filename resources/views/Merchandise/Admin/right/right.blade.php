@extends('layouts.admin.layout')
@section('title','权限管理')
@section('content')
        <!-- .box-body -->

<div class="box-header with-border">
    <h3 class="box-title">权限展示</h3>
</div>

<div class="box-body">

    <!-- 数据表格 -->
    <div class="table-box">

        <!--工具栏-->
        <div class="pull-left">
            <div class="form-group form-inline">
                <div class="btn-group">
                    <a href="{{url('/admin/rightedit')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
                    <button type="button" class="btn btn-default" title="删除" id="delMany"><i class="fa fa-trash-o"></i> 删除</button>
                    <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                </div>
            </div>
            <form action="/admin/right">
                权限名称：<input type="text" name="right_name"  >
                <button id="search"  class="btn btn-default"  type="button">查询</button>
            </form>
        </div>


    </div>
    <!--工具栏/-->


    <!--数据列表-->
    <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="" style="padding-right:0px">
                <input id="selall" type="checkbox" class="icheckbox_square-blue">
            </th>
            <th class="sorting_asc">权限ID</th>
            <th class="sorting">权限名称</th>
            <th class="sorting">权限url</th>
            <th class="sorting">权限描述</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody>
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
        var right_id=_this.parents("tr").attr('right_id');
        // $.post(
        // 	"{{url('rightdel')}}",
        // );
        if(confirm('确定要删除吗?')){
            $.ajax({
                url:"{{url('admin/rightdel')}}",
                type:"post",
                dataType:'json',
                data:{right_id:right_id},
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
    $(document).on('click',"#search",function(){
        var right_name = $("input[name='right_name']").val();
        $.ajax({
            url:"{{url('/admin/right')}}",
            type:"get",
            data:{right_name:right_name},
            success:function(res){
                $("tbody").html(res);
            }
        })
        return;

    });
    //ajax 分页
    $(document).on("click",'.page-item a',function(){
        //alert('1234');

        var url = $(this).attr('href');

        $.get(url,function(res){

            $('tbody').html(res);

        });
        return false;
    });

    //复选框
    $(document).on("click",".box",function(){
        //alert('4');
        var _this = $(this);

        var status = _this.prop('checked');

        if(status == true){
            _this.parents('tr').css('background-color','orange');
        }else{
            _this.parents('tr').css('background-color','');
        }
    });
    //点击全选
    $(document).on("click","#selall",function(){

        var _this = $(this);

        var status = $("#selall").prop("checked");

        $(".box").prop("checked",status);

        if(status == true){

            $(".box").parents("tr").css('background-color','orange');

        }else{

            $(".box").parents("tr").css('background-color','');

        }
    });
    //删除选中的商品
    $(document).on("click","#delMany",function(){
        var _this = $(this);
        //alert('7');
        var _box = $(".box:checked");
        //console.log(_box);return false;
        var right_id = "";
        _box.each(function(index){

            right_id=right_id+$(this).parent().parent().attr("right_id")+',';

        });
        //console.log(admin_id);return false;

        right_id = right_id.substring(0,right_id.length-1);

        if(right_id == ''){

            return;

        }
        //alert(admin_id);return;
        //console.log(admin_id);return false;
        var is_del = confirm('确定要删除此条商品吗?');

        if(is_del == true){

            $.ajax({
                url:"{{url('/admin/right/alldel?right_id=')}}"+right_id,
                type : 'get',
                dataType : 'json',
                success:function(res){
                    //concole.log(res);
                    if(res.error_no==0){
                        _box.each(function(index){
                            _box.parent().parent().remove();
                        });
                    }else{
                        alert(res.error_msg);
                    }
                }
            });
        }
    });
</script>



@endsection
