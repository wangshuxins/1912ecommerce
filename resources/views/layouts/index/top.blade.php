<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<!-- 头部栏位 -->
<!--页面顶部-->
<div id="nav-bottom">
	<!--顶部-->
	<div class="nav-top">
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
						<li class="f-item"><a href="{{url('/shop/homeindex')}}">个人中心</a></li>
						<li class="f-item space"></li>
						<li class="f-item"><a href="home.html" target="_blank">我的品优购</a></li>
						<li class="f-item space"></li>
						<li class="f-item">品优购会员</li>
						<li class="f-item space"></li>
						<li class="f-item">企业采购</li>
						<li class="f-item space"></li>
						<li class="f-item">关注品优购</li>
						<li class="f-item space"></li>
						<li class="f-item" id="service">
							<span>客户服务</span>
							<ul class="service">
								<li><a href="cooperation.html" target="_blank">合作招商</a></li>
								<li><a href="shoplogin.html" target="_blank">商家后台</a></li>
								<li><a href="cooperation.html" target="_blank">合作招商</a></li>
								<li><a href="#">商家后台</a></li>
							</ul>
						</li>
						<li class="f-item space"></li>
						<li class="f-item">网站导航</li>
					</ul>
				</div>
			</div>
		</div>

		<!--头部-->
		<div class="header">
			<div class="py-container">
				<div class="yui3-g Logo">
					<div class="yui3-u Left logoArea">
						<a class="logo-bd" title="品优购" href="{{url('/')}}" target="_blank"></a>
					</div>
					<div class="yui3-u Center searchArea">
						<div class="search">
							<form action="" class="sui-form form-inline">
								<!--searchAutoComplete-->
								<div class="input-append">
									<input type="text" id="autocomplete" type="text" class="input-error input-xxlarge" />
									<button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
								</div>
							</form>
						</div>
						<div class="hotwords">
							<ul>
								<li class="f-item">品优购首发</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
								<li class="f-item">每满99减30</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
								<li class="f-item">办公用品</li>

							</ul>
						</div>
					</div>
					<div class="yui3-u Right shopArea">
						<div class="fr shopcar">
							<div class="show-shopcar" id="shopcar">
								<span class="car"></span>
								<a class="sui-btn btn-default btn-xlarge" href="{{url('/shop/cart')}}" target="_blank">
									<span>我的购物车</span>
									@foreach($car as $kl=>$vl)
										<i class="shopnum">{{$kl+1}}</i>
									@endforeach
								</a>
								<div class="clearfix shopcarlist" id="shopcarlist" style="display:none">
									@foreach($car as $k=>$v)
									@if($k<=4)
									</b><img  width="30" src="/{{$v['goods_img']}}"></b>
									@endif
									@if($k==5)
										........
									@endif
									@endforeach
									</div>
							</div>
						</div>
					</div>

				</div>

				<div class="yui3-g NavList">
					<div class="yui3-u Left all-sort" id="all">
						<h4>全部商品分类</h4>
					</div>
					<div class="yui3-u Center navArea">
						<ul class="nav">
							<li class="f-item"><a style="text-decoration:none" href="{{url('/')}}"><font color='black'>首页</font></a></li>
							<li class="f-item"><a style="text-decoration:none" href="{{url('/shop/search/0')}}"><font color='black'>全部</font></a></li>
							@foreach($dingji as $v)
							<li class="f-item"><a style="text-decoration:none" href="{{url('/shop/search/'.$v->cate_id)}}"><font color='black'>{{$v->cate_name}}</font></a></li>
							@endforeach
							<li class="f-item"><a href="{{url('/shop/seckillindex')}}" target="_blank">秒杀</a></li>
						</ul>
					</div>
					<div class="yui3-u Right"></div>
				</div>
			</div>
		</div>
	</div>
</div>
{{--<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>

<!-- 头部栏位 -->
<!--页面顶部-->
<div id="nav-bottom">
	<!--顶部-->
	<div class="nav-top">
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
						<li class="f-item"><a href="{{url('/shop/homeindex')}}">个人中心</a></li>
						<li class="f-item space"></li>
						<li class="f-item"><a href="home.html" target="_blank">我的品优购</a></li>
						<li class="f-item space"></li>
						<li class="f-item">品优购会员</li>
						<li class="f-item space"></li>
						<li class="f-item">企业采购</li>
						<li class="f-item space"></li>
						<li class="f-item">关注品优购</li>
						<li class="f-item space"></li>
						<li class="f-item" id="service">
							<span>客户服务</span>
							<ul class="service">
								<li><a href="cooperation.html" target="_blank">合作招商</a></li>
								<li><a href="shoplogin.html" target="_blank">商家后台</a></li>
								<li><a href="cooperation.html" target="_blank">合作招商</a></li>
								<li><a href="#">商家后台</a></li>
							</ul>
						</li>
						<li class="f-item space"></li>
						<li class="f-item">网站导航</li>
					</ul>
				</div>
			</div>
		</div>

		<!--头部-->
		<div class="header">
			<div class="py-container">
				<div class="yui3-g Logo">
					<div class="yui3-u Left logoArea">
						<a class="logo-bd" title="品优购" href="JD-index.html" target="_blank"></a>
					</div>
					<div class="yui3-u Center searchArea">
						<div class="search">
							<form action="" class="sui-form form-inline">
								<!--searchAutoComplete-->
								<div class="input-append">
									<input type="text" id="autocomplete" type="text" class="input-error input-xxlarge" />
									<button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
								</div>
							</form>
						</div>
						<div class="hotwords">
							<ul>
								<li class="f-item">品优购首发</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
								<li class="f-item">每满99减30</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
								<li class="f-item">办公用品</li>

							</ul>
						</div>
					</div>
					<div class="yui3-u Right shopArea">
						<div class="fr shopcar">
							<div class="show-shopcar" id="shopcar">
								<span class="car"></span>
								<a class="sui-btn btn-default btn-xlarge" href="{{url('/shop/cart')}}" target="_blank">
									<span>我的购物车</span>
									@foreach($car as $kl=>$vl)
										<i class="shopnum">{{$kl+1}}</i>
									@endforeach
								</a>
								<div class="clearfix shopcarlist" id="shopcarlist" style="display:none">
									@foreach($car as $k=>$v)
									@if($k<=4)
									</b><img  width="30" src="/{{$v['goods_img']}}"></b>
									@endif
									@if($k==5)
										........
									@endif
									@endforeach
									</div>
							</div>
						</div>
					</div>

				</div>

				<div class="yui3-g NavList">
					<div class="yui3-u Left all-sort">
						<h4>全部商品分类</h4>
					</div>
					<div class="yui3-u Center navArea">
						<ul class="nav">
							<li class="f-item"><a style="text-decoration:none" href="{{url('/')}}"><font color='black'>首页</font></a></li>
							<li class="f-item"><a style="text-decoration:none" href="{{url('/shop/search/0')}}"><font color='black'>全部</font></a></li>
							@foreach($dingji as $v)
							<li class="f-item"><a style="text-decoration:none" href="{{url('/shop/search/'.$v->cate_id)}}"><font color='black'>{{$v->cate_name}}</font></a></li>
							@endforeach
							<li class="f-item"><a href="{{url('/shop/seckillindex')}}" target="_blank">秒杀</a></li>
						</ul>
					</div>
					<div class="yui3-u Right"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--列表-->
--}}

