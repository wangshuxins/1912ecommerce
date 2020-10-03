<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
     <link rel="icon" href="/assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-seckillOrder.css" />
</head>

<body>
@include('layouts.index.top')
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
<script type="text/javascript" src="/index/static/js/plugins/birthday/birthday.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/upload/uploadPreview.js"></script>
<script type="text/javascript" src="/index/static/js/pages/main.js"></script>
<script>
            $(function() {               
                $.ms_DatePicker({
                    YearSelector: "#select_year2",
                    MonthSelector: "#select_month2",
                    DaySelector: "#select_day2"
                });
            });
        </script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
               @include('layouts.index.left')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userInfo">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">基本资料</a></li>
                            <li><a href="#two" data-toggle="tab"></a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane active">
                                <form id="form-msg" class="sui-form form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label for="inputName" class="control-label">昵称：</label>
                                        <div class="controls">
                                            <input type="text" id="inputName" name="user_name" placeholder="昵称">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputGender" class="control-label">性别：</label>
                                        <div class="controls">
                                            <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="user_sex" value="1"><span>男</span>
                                        </label>
                                            <label data-toggle="radio" class="radio-pretty inline">
                                            <input type="radio" name="user_sex" value="2"><span>女</span>
                                        </label>
                                        </div>
                                    </div>

                                     <div class="control-group">
                                        <label for="inputName" class="control-label">爱好：</label>
                                        <div class="controls">
                                            <input type="text" id="inputName" name="hobby" placeholder="爱好">
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
                                        <label for="sanwei" class="control-label"></label>
                                        <div class="controls">
                                            <button type="button" class="sui-btn btn-primary submit">立即注册</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="two" class="tab-pane">

                                <div class="new-photo">
                                    <p>当前头像：</p>
                                    <div class="upload">
                                        <img id="imgShow_WU_FILE_0" width="100" height="100" src="/index/static/img/_/photo_icon.png" alt="">
                                        <input type="file" class="form-control" name="user_img"  id="lastname" 
				   >
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
    <!--页面底部-->
    @include('layouts.index.footer')
<!--页面底部END-->

undefined


</html>
<script>
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
            var user_sex = $("input[name='user_sex']").val();
            var hobby = $("input[name='hobby']").val();
            var user_img = $("input[name='user_img']").val();
            //alert(user_img);
          
            $.ajax({
                url:"{{url('/shop/saveinfo')}}",
                type:'post',
                data:{user_name:user_name,province:province,city:city,area:area,user_sex:user_sex,hobby:hobby,user_img:user_img},
                dataType:'json',
                success:function(res){
                    if(res.error_no==0){
                        alert(res.error_msg);
                    }else{
                        alert(res.error_msg);
                    }
                    //alert(res);
                    
                }

            })
        })
</script>
