@extends('layouts.admin.layout')
@section('title','角色添加')
@section('content')
    <section class="content">

        <div class="box-body">

            <!--tab页-->
            <div class="nav-tabs-custom">

                <!--tab头-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">角色添加</a>
                    </li>
                </ul>
                <!--tab头/-->

                <!--tab内容-->
                <div class="tab-content">
                    <!--表单内容-->
                        <div class="tab-pane active" id="home">
                            <div class="row data-type">
                                <div class="col-md-2 title">选择角色</div>

                                <div class="col-md-10 data">
                                    <center>
                                        @foreach($role as $v)
                                          <th class="" style="padding-right:0px">
                                              <input  type="checkbox" value="{{$v->role_id}}" class="icheckbox_square-blue checkboxs">{{$v->role_name}}
                                          </th>
                                        @endforeach
                                            <th class="" style="padding-right:0px">
                                                <input id="user_id"  type="hidden" value="{{$id}}" class="icheckbox_square-blue">
                                            </th>
                                    </center>
                                </div>
                                </div>
                            </div>
                </div>
                <!--tab内容/-->
                <!--表单内容/-->

            </div>
        </div>
        <div class="btn-toolbar list-toolbar">
            <a class="btn btn-default" href="javascript:void(0);" id="submit">保存</a>
            <a class="btn btn-default" href="{{url('/admin/admin/index')}}">返回列表</a>
        </div>
        <script>
          $(document).on('click','#submit',function(){

              var user_id = $('#user_id').val();

              var checked = [];

              $('input:checkbox:checked').each(function(){
                  checked.push($(this).val());
              });
              if(checked==''){
                  return;
              }
              $.ajax({
                  url:"/admin/admin/roles/"+checked,
                  type:'post',
                  data:{user_id:user_id},
                  dataType:'json',
                  success:function(res){
                    if(res.error_no==0){
                        alert(res.error_msg)
                    }else if(res.error_no==2){
                        alert(res.error_msg)
                    }
                  }
              })

          })
        </script>
    </section>
@endsection