<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>我的购物车</title>
    <link rel="icon" href="/assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-cart.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-seckillOrder.css" />
	<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
</head>

<body>
	<!--head-->
	<div class="top">
		<div class="py-container">
			<div class="shortcut">
				<ul class="fl">
					<li class="f-item">品优购&nbsp
						@if(session('users'))
							欢迎<font color="orange">{{session('users')['user_name']}}</font>登录&nbsp </li>
					@endif
					<li class="f-item">
						@if(!session('users'))
							请<a href="{{url('/shop/login')}}" target="_blank">登录</a>
						@endif<span><a href="{{url('/shop/register')}}" target="_blank">免费注册</a>&nbsp;&nbsp;
							@if(session('users'))
								<a href="{{url('/shop/qiut')}}">退出登录</a>
							@endif
								</span></li>
				</ul>
				<ul class="fr">
					<li class="f-item"><a href="{{url('/shop/homeindex')}}">我的订单</a></li>
					<li class="f-item space"></li>
					<li class="f-item">我的品优购</li>
					<li class="f-item space"></li>
					<li class="f-item">品优购会员</li>
					<li class="f-item space"></li>
					<li class="f-item">企业采购</li>
					<li class="f-item space"></li>
					<li class="f-item">关注品优购</li>
					<li class="f-item space"></li>
					<li class="f-item">客户服务</li>
					<li class="f-item space"></li>
					<li class="f-item">网站导航</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="cart py-container">
		<!--logoArea-->
		<div class="logoArea">
			<div class="fl logo"><span class="title"></span></div>
			<div class="fr search">
				<form class="sui-form form-inline">
					<div class="input-append">
						<input type="text" type="text" class="input-error input-xxlarge" placeholder="品优购自营" />
						<button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
					</div>
				</form>
			</div>
		</div>