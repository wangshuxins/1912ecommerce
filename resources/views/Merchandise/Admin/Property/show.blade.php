@extends('layouts.admin.layout')
@section('title','商品管理')
@section('content')
<!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">商品管理</h3>
                    </div>
                    <div class="box-body">
                        <!-- 数据表格 -->
                        <div class="table-box">
                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <a  href="{{url('/admin/addition')}}" class="btn btn-default" title="新建" ><i class="fa fa-file-o"></i> 新建</a>
                                        <button type="button" class="btn btn-default" title="删除" ><i class="fa fa-trash-o"></i> 删除</button>
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                  状态：<select>
                                            <option value="">全部</option>      
                                            <option value="0">未申请</option>    
                                            <option value="1">申请中</option>    
                                            <option value="2">审核通过</option>    
                                            <option value="3">已驳回</option>                                     
                                        </select>
                                     商品名称：<input type="text" name="attr_name" value="{{$attr_name}}">                                   
                                    <button class="btn btn-default" id="graphery" >查询</button>                                    
                                </div>
                            </div>
                            <!--工具栏/-->
                                    
                              <!--数据列表-->
                              <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                                <center>{{session("get")}}</center>
                                  <thead>
                                      <tr>
                                          <th>属性名ID</th>
                                          <th>属性名</th>
                                          <th>属性名添加时间</th>
                                          <th>操作</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($name as $a=>$v)
                                      <tr center="center">
                                          <td>{{$v["id"]}}</td>
                                          <td>{{$v["attr_name"]}}</td>
                                          <td>{{date("Y-m-s H:i:s",$v["add_time"])}}</td>
                                          <td class="text-center">
                                                <a id="del" slide_id="{{$v['id']}}" class="btn bg-olive btn-xs">删除</a>
                                                <a href="{{url('/admin/attrupdate/'.$v['id'])}}" class="btn bg-olive btn-xs">修改</a>
                                          </td>
                                      </tr>
                                        
                                      @endforeach
                                        <td colspan="5" align="center">
                                          {{$name->appends(['attr_name'=>$attr_name])->links()}}
                                        </td>
                                  </tbody>
                              </table>
                              <!--数据列表/-->
                        </div>
                        <!-- 数据表格 /-->
                     </div><!-- /.box-body -->
<script>
$(function(){
    //js删除
    $(document).on("click","#del",function(){
      var _this = $(this);
      var slide_id = _this.attr("slide_id");
      if(window.confirm("你要删除这条数据吗")){
        var url = "/admin/deletion/"+slide_id;
        location.href=url;
      }
    });
    //ajax搜索
    $("#graphery").click(function(){
      var attr_name = $("input[name='attr_name']").val();
      var url = "/admin/display";
      $.ajax({
        url:url,
        type:"get",
        data:{attr_name:attr_name},
        async:true,
        success:function(index){
          $("table").html(index);
        }
      });
    });
    //ajax分页
    $(document).on("click",".page-item a",function(){
      var url_sel = $(this).attr("href");
      $.get(url_sel,function(index){
          $("table").html(index);
      });
      return false;
    });

});
</script>
@endsection
 
