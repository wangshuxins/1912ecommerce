<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
     <link rel="icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-seckillOrder.css" />
</head>

<body>
@include('layouts.index.top')
<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#service").hover(function(){
		$(".service").show();
	},function(){
		$(".service").hide();
	});
	$("#shopcar").hover(function(){
		$("#shopcarlist").show();
	},function(){
		$("#shopcarlist").hide();
	});

})
</script>
<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/index/static/js/widget/nav.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="/index/static/js/pages/main.js"></script>


</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
                
					@include('layouts.index.left')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userAddress">
                        <div class="address-title">
                            <span class="title">地址管理</span>
                            <a data-toggle="modal" data-target=".edit" data-keyboard="false"   class="sui-btn  btn-info add-new">添加新地址</a>
                            <span class="clearfix"></span>
                        </div>
                        <div class="address-detail">
                            <table class="sui-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>收货人姓名</th>
                                        <th>配送区域</th>
                                        <th>详细地址</th>
                                        <th>联系电话</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @foreach($add as $v)
                                    <tr>
                                        <td>{{$v->user_name}}</td>
                                        <td>{{$v->province}}&nbsp;{{$v->city}}&nbsp;{{$v->area}}</td>
                                        <td>{{$v->paddress}}</td>
                                        <td>{{$v->tel}}</td>
                                        <td>
                                            <a href="{{url('shop/home/exit/'.$v->id)}}">编辑</a>
                                            <a href="javascript:void(0)" class="del"  id="{{$v->id}}">删除</a>
                                            <a href="javascript:void(0)" address_id="{{$v->id}}" class="default" is_default="{{$v->is_default}}">{{$v->is_default==2?"取消默认":"设为默认"}}</a>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>                          
                        </div>
                        <!--新增地址弹出层-->
                <div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit" style="width:580px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                   <h4 id="myModalLabel" class="modal-title">新增地址</h4>
                			</div>
                    <div class="modal-body">
                                <form action="" class="sui-form form-horizontal">
                            		<div class="control-group">
                                    <label class="control-label">收货人：</label>
                                    	 <div class="controls">
                                                <input type="text" class="input-medium" name="user_name">
                                         </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">所在地区：</label>
                                            <div class="controls">
                                                <div class="form-group area">
                                                    <select class="areas" name="province" >
                                                        <option value="0" selected="selected">请选择...</option>
                                                       @foreach($provinceInfo as $v)
                                                        <option value="{{$v->id}}" >{{$v->name}}</option>
                                                       @endforeach
                                                    </select>
                                                    <select class="areas" name="city" >
                                                        <option value="0" selected="selected">请选择...</option>
                                                    </select>
                                                    <select class="areas" name="area" >
                                                        <option value="0" selected="selected">请选择...</option>

                                                    </select>
                                                    （必填）
                                                </div>
                                            </div>
                                            </div>
                                    <div class="control-group">
                                        <label class="control-label">联系电话：</label>
                                        <div class="controls">
                                            <input type="text" class="input-medium" name="tel">
                                        </div>
                                    </div>
                                        <div class="control-group">
                                            <label class="control-label">选择默认:</label>
                                            <div class="controls">
                                                <input type="radio" checked class="input-large" name="is_default" value="1">普通收货
                                                <input type="radio" class="input-large" name="is_default" value="2">默认收货
                                            </div>
                                        </div>

                                    <div class="control-group">
                                        <label class="control-label">详细地址：</label>
                                        <div class="controls">
                                            <textarea type="text" class="input-large" name="paddress"></textarea>
                                        </div>
                                    </div>
                                </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"  class="sui-btn btn-primary btn-large submit">确定</button>
                                        <button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">取消</button>
                                    </div>
                                </div>
                            </div>
						</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
@include('layouts.index.footer')

<script>
    $(function(){
        $(document).on("change",".areas",function(){

            var _this = $(this);

            _this.nextAll('select').html("<option value='0'>请选择...</option>");

            var id = _this.val();

            $.ajax({
                url:"{{url('/shop/index/getArea')}}",
                data : {'id':id},
                type:'post',
                success:function(res){
                    _this.next("select").html(res);
                }
            });
        });
        $(document).on("click",".submit",function(){
            var user_name = $("input[name='user_name']").val();
            var province = $("select[name='province']").val();
            var city = $("select[name='city']").val();
            var area = $("select[name='area']").val();
            var paddress = $("textarea[name='paddress']").val();
            var tel = $("input[name='tel']").val();
            var is_default = $("input[name='is_default']:checked").val();
            $.ajax({
                url:"{{url('/shop/saveaddress')}}",
                type:'post',
                data:{'user_name':user_name,'province':province,'city':city,'area':area,'paddress':paddress,'tel':tel,'is_default':is_default},
                dataType:'json',
                success:function(res){
                    if(res.error_no==0){
                        alert(res.error_msg);
                        location.href="{{url('/shop/homesettingaddress')}}";
                    }else{
                        alert(res.error_msg);
                    }
                }

            })
        })
        $(document).on('click',".default",function(){
            var _this = $(this);
            var is_default = _this.attr('is_default');
            var address_id = _this.attr('address_id');

            if(is_default==1){
                var status = 2;
                _this.text('取消默认');
            }else{
                var status = 1;
                _this.text('设为默认');
            }
            $.ajax({
                url:"{{url('/shop/setDefault')}}",
                type:'post',
                data:{'address_id':address_id,'status':status},
                dataType:'json',
                success:function(res){
                    if(res.error_no==0){
                        console.log(res.error_msg);
                        location.href="{{url('/shop/homesettingaddress')}}";
                    }else{
                        alert(res.error_msg);
                    }
                }
            })
            return;
        });
        $(document).on('click','.del',function(){
            var _this = $(this);
            var id = _this.attr('id');
            $.ajax({
                url:"{{url('/shop/home/del')}}",
                data : {'id':id},
                type:'post',
                dataType:'json',
                success:function(res){
                    _this.parents('tr').remove();
                }
            });
        });
    });


</script>

  

</html>