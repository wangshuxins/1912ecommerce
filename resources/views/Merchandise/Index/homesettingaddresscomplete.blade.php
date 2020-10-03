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
<script type="text/javascript" src="/index/static/js/widget/nav.js"></script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
               @include('layouts.index.left')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li><a href="#one" data-toggle="tab">密码设置</a></li>
                            <li class="active"><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane">
                                <form class="sui-form form-horizontal sui-validate" id="jsForm">
                                    <div class="control-group">
                                        <label for="inputusername" class="control-label">用户名：</label>
                                        <div class="controls">
                                            <input id="pwdid" class="fn-tinput" data-rule-remote="http://www.baidu.com" type="password" name="OldPassword" placeholder="输入昵称"
                                                required data-msg-required="请输入昵称" minlength="6" data-msg-minlength="至少输入6个字符"
                                            />

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required id="password" data-rule-remote="php.php">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">重复密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="confirm_password" value="" placeholder="确认新密码" required equalTo="#password">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <button type="submit" class="sui-btn btn-primary">提交按钮</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="two" class="tab-pane active">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第二步 绑定新手机号</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">3</span><span>第三步 完成</span></label>
                                        </div>
                                    </div>
                                </div>
                                <!--完成-->
                                <div class="overed">
                                    <div class="content">
                                         <div class="img">
                                             <img src="/index/static/img/_/right.png" alt="">
                                        </div>
                                        <div class="text">
                                            <p class="success">恭喜你，新手机绑定成功！</p>
                                            <p class="back"><a href="{{url('/shop/homesettingsafe')}}">返回首页</a></p>
                                        </div>
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