<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，欢迎登录</title>

    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-login.css" />
</head>


<body>
	<div class="login-box">
		<!--head-->
		<div class="py-container logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--loginArea-->
		<div class="loginArea">
			<div class="py-container login">
				<div class="loginform">
					<ul class="sui-nav nav-tabs tab-wraped">
						<li>
							<a href="#index" data-toggle="tab">
								<h3>扫描登录</h3>
							</a>
						</li>
						<li class="active">
							<a href="#profile" data-toggle="tab">
								<h3>账户登录</h3>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane">
							<p>二维码登录，暂为官网二维码</p>
							<img src="/index/static/img/wx_cz.jpg" />
						</div>
						<div id="profile" class="tab-pane  active">
							<form class="sui-form">
								<div class="input-prepend"><span class="add-on loginname"></span>
									<input id="prependedInput" type="text" placeholder="邮箱/用户名/手机号" name="user_name" class="span2 input-xfat">
								</div>
								<div class="input-prepend"><span class="add-on loginpwd"></span>
									<input id="prependedInput" type="password" placeholder="请输入密码" name="user_pwd" class="span2 input-xfat">
								</div>
								<div class="setting">
									<label class="checkbox inline">
									<input type="checkbox" value="1" name="remember_me">七天免登录
										</label>
									<span class="forget">忘记密码？</span>
								</div>
								<div class="logined">
									<a class="sui-btn btn-block btn-xlarge btn-danger submit">登&nbsp;&nbsp;录</a>
								</div>
							</form>
							<div class="otherlogin">
								<div class="types">
									<ul>
										<li><img src="/index/static/img/qq.png" width="35px" height="35px" /></li>
										<li><img src="/index/static/img/sina.png" /></li>
										<li><img src="/index/static/img/ali.png" /></li>
										<li><img src="/index/static/img/weixin.png" /></li>
									</ul>
								</div>
								<span class="register"><a href="{{url('/shop/register')}}" target="_blank">立即注册</a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>

<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/index/static/js/pages/login.js"></script>
</body>

</html>
<script>
	$(document).on('click','.submit',function(){
		//获取文本框的值
		var user_name=$("input[name='user_name']").val();
		var user_pwd=$("input[name='user_pwd']").val();
		var remember_me = $('[name="remember_me"]:checked').val();
		//验证
		if(user_name==''){
			alert('用户名不能为空');
		}
		var reg=/^(?![^a-zA-Z]+$){3,6}/
		if(user_pwd==''){
			alert('密码不能为空');
		}else if(reg.test(user_pwd)){
			alert('密码必须是3-6位');
		}
		$.ajax({
			url:"{{url('shop/logindo')}}",
			data:{user_name:user_name,user_pwd:user_pwd,remember_me:remember_me},
			dataType:"json",
			type:"post",
			success:function(res){
				if(res.error_no==1){
					alert(res.error_msg);	
				}
				if(res.error_no==0){
					alert(res.error_msg);
					location.href="/";
				}
			}
			
		})
	})
</script>