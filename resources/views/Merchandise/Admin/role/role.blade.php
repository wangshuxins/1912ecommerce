@extends('layouts.admin.layout')
@section('title','角色权限')
@section('content')
        <!-- .box-body -->
<div class="box-header with-border">
    <h3 class="box-title">角色展示</h3>
</div>
<div class="box-body">

    <!-- 数据表格 -->
    <div class="table-box">

        <!--工具栏-->
        <div class="pull-left">
            <div class="form-group form-inline">
                <div class="btn-group">
                    <a href="{{url('/admin/rolecreate')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
                    <button type="button" class="btn btn-default" title="删除" id="delMany"><i class="fa fa-trash-o"></i> 删除</button>
                    <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                </div>
            </div>
            角色名称：<input type="text" name="role_name" >
            <button id="search">查询</button>
        </div>


    </div>
    <!--工具栏/-->
    <center>
    <p><font color="red">{{session('msg')}}</font></p>
        </center>

    <!--数据列表-->
    <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="" style="padding-right:0px">
                <input id="selall"  type="checkbox" class="icheckbox_square-blue">
            </th>
            <th class="sorting_asc">角色ID</th>
            <th class="sorting">角色名称</th>
            <th class="sorting">角色描述</th>
            <th class="sorting">添加时间</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody>
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
                    <a href="{{url('/admin/admin/rights/'.$v->role_id)}}">
                        <button type="button" class="btn bg-olive btn-xs">添加权限</button>
                    </a>
                    <a href="{{url('/admin/admin/rightsdel/'.$v->role_id)}}">
                        <button type="button" class="btn bg-olive btn-xs">删除权限</button>
                    </a>
                </td>

            </tr>
        @endforeach
        <tr>
            <td align="center" colspan="6">{{$role->appends(['$role_name'=>$role_name])->links()}}</td>
        </tr>
        </tbody>
    </table>
</div>
</div>
<script>
    //删除
    $(document).on('click','.del',function(){
        //获取点击的这个对象
        var _this=$(this);
        //点击获取用户id
        var role_id=_this.attr('role_id');
        if(confirm('确定要删除吗？')){
            $.ajax({
                url:"{{url('/admin/roledelete')}}",
                type:"post",
                dataType:'json',
                data:{role_id:role_id},
                success:function(res){
                    //alert(res);
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
    $(document).on("click","#search",function(){

        var role_name = $("input[name='role_name']").val();

        $.ajax({
            url:"{{url('/admin/role/')}}",
            type:'post',
            data:{role_name:role_name},
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
        var role_id = "";
        _box.each(function(index){

            role_id=role_id+$(this).parent().parent().attr("role_id")+',';

        });
        //console.log(admin_id);return false;

        role_id = role_id.substring(0,role_id.length-1);

        if(role_id == ''){

            return;

        }

        //alert(admin_id);return;
        //console.log(admin_id);return false;
        var is_del = confirm('确定要删除此条商品吗?');

        if(is_del == true){

            $.ajax({
                url:"{{url('/admin/role/alldel?role_id=')}}"+role_id,
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
