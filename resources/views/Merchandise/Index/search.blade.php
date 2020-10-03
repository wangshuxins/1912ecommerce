<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>产品列表页</title>
	<link rel="icon" href="assets//index/static/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="/index/static/css/pages-list.css" />
	<link rel="stylesheet" type="text/css" href="/index/static/css/widget-cartPanelView.css" />
</head>
<body>
<!-- 头部栏位 -->
<!--页面顶部-->
@include('layouts.index.top')
		<!--list-content-->
<div class="main">
	<div class="py-container">
		<!--bread-->
		<div class="bread">
			<ul class="fl sui-breadcrumb">
				<li>
					<a  style="text-decoration: none" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</a>
				</li>
				<li class="active">智能手机</li>
			</ul>
			<ul class="tags-choose">
				<li class="tag" id="brand_name" style="display:none">品牌<i class="sui-icon icon-tb-close">
					</i>
				</li>
				<li class="tag" id="brand_price" style="display:none">价格<i class="sui-icon icon-tb-close">
					</i>
				</li>
			</ul>
			{{--<form class="fl sui-form form-dark">--}}
			{{--<div class="input-control control-right">--}}
			{{--<input type="text" />--}}
			{{--<i class="sui-icon icon-touch-magnifier"></i>--}}
			{{--</div>--}}
			{{--</form>--}}
			<div class="clearfix"></div>
		</div>
		<!--selector-->
		<div class="clearfix selector">
			<div class="type-wrap logo">
				<div class="fl key brand">品牌</div>
				<div class="value logos">
					@foreach($brand as $v)
						<ul class="logo-list">
							<li class="brand_name" brand_name="{{$v->brand_name}}" brand_id="{{$v->brand_id}}" value="{{$v->brand_id}}"><img style="width:120px;height:50px" src="/{{$v->brand_log}}" /></li>
						</ul>
					@endforeach
				</div>

			</div>

			<div class="type-wrap">
				<div class="fl key">价格</div>
				<div class="fl value">

					<ul class="type-list" id="td_a">
						@foreach($priceInfo as $v)
							<li class="li">
								<a class="goods_price"  href="javascript:void(0);">{{$v}}</a>
							</li>
						@endforeach
					</ul>

				</div>
				<div class="fl ext">
				</div>
			</div>

		</div>
		<!--details-->
		<div class="details">
			<div class="sui-navbar">
				<div class="navbar-inner filter">
					<ul class="sui-nav">
						<li  class="default active" field="is_show">
							<a  href="javascript:void(0)">综合</a>
						</li>
						<li class="default" field="is_new">
							<a  href="javascript:void(0)" >最新</a>
						</li>
						<li class="default" field="is_hot">
							<a href="javascript:void(0)">最热</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="show">
				<div class="goods-list">
					<ul class="yui3-g">
						@foreach($limit as $v)
							<li class="yui3-u-1-5">
								<div class="list-wrap">
									<div class="p-img">
										<a href="{{url('shop/item/'.$v->goods_id)}}" target="_blank"><img src="/{{$v->goods_img}}" /></a>
									</div>
									<div class="price">
										<strong>
											<em>¥</em>
											<i>{{$v->goods_price}}.00</i>
										</strong>
									</div>
									<div class="attr">
										<em>{{$v->goods_name}}</em>
									</div>
									<div class="cu">
										<!-- 									<em><span>促</span>满一件可参加超值换购</em>
                                         -->								</div>
									<div class="commit">
										<!-- 									<i class="command">已有2000人评价</i>
                                         -->								</div>
									<div class="operate">
										<a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
										<a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
										<a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
				<div class="fr page">
					<div class="sui-pagination pagination-large">
						<ul>
							<li class="prev disabled">
								<a href="#">«上一页</a>
							</li>
							<li class="active">
								{!! $str  !!}
							</li>
							<li class="next">
								<a href="#">下一页»</a>
							</li>
						</ul>
						<div><span>共10页&nbsp;</span><span>
      到第
      <input type="text" class="page-num">
      页 <button class="page-confirm" onclick="alert(1)">确定</button></span></div>
					</div>
				</div>
			</div>

		</div>
		<!--hotsale-->
		<div class="clearfix hot-sale">
			<h4 class="title">热卖商品</h4>
			<div class="hot-list">
				<ul class="yui3-g">
					<li class="yui3-u-1-4">
						<div class="list-wrap">
							<div class="p-img">
								<img src="/index/static/img/like_01.png" />
							</div>
							<div class="attr">
								<em>Apple苹果iPhone 6s (A1699)</em>
							</div>
							<div class="price">
								<strong>
									<em>¥</em>
									<i>4088.00</i>
								</strong>
							</div>
							<div class="commit">
								<i class="command">已有700人评价</i>
							</div>
						</div>
					</li>
					<li class="yui3-u-1-4">
						<div class="list-wrap">
							<div class="p-img">
								<img src="/index/static/img/like_03.png" />
							</div>
							<div class="attr">
								<em>金属A面，360°翻转，APP下单省300！</em>
							</div>
							<div class="price">
								<strong>
									<em>¥</em>
									<i>4088.00</i>
								</strong>
							</div>
							<div class="commit">
								<i class="command">已有700人评价</i>
							</div>
						</div>
					</li>
					<li class="yui3-u-1-4">
						<div class="list-wrap">
							<div class="p-img">
								<img src="/index/static/img/like_04.png" />
							</div>
							<div class="attr">
								<em>256SSD商务大咖，完爆职场，APP下单立减200</em>
							</div>
							<div class="price">
								<strong>
									<em>¥</em>
									<i>4068.00</i>
								</strong>
							</div>
							<div class="commit">
								<i class="command">已有20人评价</i>
							</div>
						</div>
					</li>
					<li class="yui3-u-1-4">
						<div class="list-wrap">
							<div class="p-img">
								<img src="/index/static/img/like_02.png" />
							</div>
							<div class="attr">
								<em>Apple苹果iPhone 6s (A1699)</em>
							</div>
							<div class="price">
								<strong>
									<em>¥</em>
									<i>4088.00</i>
								</strong>
							</div>
							<div class="commit">
								<i class="command">已有700人评价</i>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- 底部栏位 -->
<!--页面底部-->
@include('layouts.index.footer')
		<!--页面底部END-->
<!--侧栏面板开始-->
<div class="J-global-toolbar">
	<div class="toolbar-wrap J-wrap">
		<div class="toolbar">
			<div class="toolbar-panels J-panel">

				<!-- 购物车 -->
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="" class="title"><i></i><em class="title">购物车</em></a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('cart');" ></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div id="J-cart-tips" class="tbar-tipbox hide">
								<div class="tip-inner">
									<span class="tip-text">还没有登录，登录后商品将被保存</span>
									<a href="#none" class="tip-btn J-login">登录</a>
								</div>
							</div>
							<div id="J-cart-render">
								<!-- 列表 -->
								<div id="cart-list" class="tbar-cart-list">
								</div>
							</div>
						</div>
					</div>
					<!-- 小计 -->
					<div id="cart-footer" class="tbar-panel-footer J-panel-footer">
						<div class="tbar-checkout">
							<div class="jtc-number"> <strong class="J-count" id="cart-number">0</strong>件商品 </div>
							<div class="jtc-sum"> 共计：<strong class="J-total" id="cart-sum">¥0</strong> </div>
							<a class="jtc-btn J-btn" href="#none" target="_blank">去购物车结算</a>
						</div>
					</div>
				</div>

				<!-- 我的关注 -->
				<div style="visibility: hidden;" data-name="follow" class="J-content toolbar-panel tbar-panel-follow">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="#" target="_blank" class="title"> <i></i> <em class="title">我的关注</em> </a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('follow');"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div class="tbar-tipbox2">
								<div class="tip-inner"> <i class="i-loading"></i> </div>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>

				<!-- 我的足迹 -->
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-history toolbar-animate-in">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="#" target="_blank" class="title"> <i></i> <em class="title">我的足迹</em> </a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('history');"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div class="jt-history-wrap">
								<ul>
									<!--<li class="jth-item">
                                    <a href="#" class="img-wrap"> <img src=".portal//index/static/img/like_03.png" height="100" width="100" /> </a>
                                    <a class="add-cart-button" href="#" target="_blank">加入购物车</a>
                                    <a href="#" target="_blank" class="price">￥498.00</a>
                                </li>
                                <li class="jth-item">
                                    <a href="#" class="img-wrap"> <img src="portal//index/static/img/like_02.png" height="100" width="100" /></a>
                                    <a class="add-cart-button" href="#" target="_blank">加入购物车</a>
                                    <a href="#" target="_blank" class="price">￥498.00</a>
                                </li>-->
								</ul>
								<a href="#" class="history-bottom-more" target="_blank">查看更多足迹商品 &gt;&gt;</a>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>

			</div>

			<div class="toolbar-header"></div>
			<!-- 侧栏按钮 -->
			<div class="toolbar-tabs J-tab">
				<div onclick="cartPanelView.tabItemClick('cart')" class="toolbar-tab tbar-tab-cart" data="购物车" tag="cart">
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count " id="tab-sub-cart-count">0</span>
				</div>
				<div onclick="cartPanelView.tabItemClick('follow')" class="toolbar-tab tbar-tab-follow" data="我的关注" tag="follow">
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count hide">0</span>
				</div>
				<div onclick="cartPanelView.tabItemClick('history')" class="toolbar-tab tbar-tab-history" data="我的足迹" tag="history">
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count hide">0</span>
				</div>
			</div>

			<div class="toolbar-footer">
				<div class="toolbar-tab tbar-tab-top">
					<a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a>
				</div>
				<div class="toolbar-tab tbar-tab-feedback">
					<a href="#" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a>
				</div>
			</div>

			<div class="toolbar-mini"></div>

		</div>

		<div id="J-toolbar-load-hook"></div>

	</div>
</div>
<!--购物车单元格 模板-->
<script type="text/template" id="tbar-cart-item-template">
	<div class="tbar-cart-item">
		<div class="jtc-item-promo">
			<em class="promo-tag promo-mz">满赠<i class="arrow"></i></em>
			<div class="promo-text">已购满600元，您可领赠品</div>
		</div>
		<div class="jtc-item-goods">
			<span class="p-img"><a href="#" target="_blank"><img src="{2}" alt="{1}" height="50" width="50" /></a></span>
			<div class="p-name">
				<a href="#">{1}</a>
			</div>
			<div class="p-price"><strong>¥{3}</strong>×{4} </div>
			<a href="#none" class="p-del J-del">删除</a>
		</div>
	</div>
</script>
<!--侧栏面板结束-->
<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#service").hover(function() {
			$(".service").show();
		}, function() {
			$(".service").hide();
		});
		$("#shopcar").hover(function() {
			$("#shopcarlist").show();
		}, function() {
			$("#shopcarlist").hide();
		});
	})
</script>
<script type="text/javascript" src="/index/static/js/model/cartModel.js"></script>
<script type="text/javascript" src="/index/static/js/czFunction.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/index/static/js/widget/cartPanelView.js"></script>
</body>
<script>
	$(function(){
		//点击事件--点击品牌
		$(document).on("click",".brand_name",function(){
			//alert('123');
			var _this = $(this);
			//特效
			_this.parent().addClass('nowbrand').siblings("ul").removeClass('nowbrand');

			var brand_id = _this.attr('brand_id');

			var brand_name = _this.attr('brand_name');

			$("#brand_name").show();

			$("#brand_name").html(brand_name+"<a id='delbrand_id' brand_id="+brand_id+">×</a>");

			//重新获取此品牌的商品列表
			$.ajax({
				url:"{{url('/shop/index/search/')}}",
				dataType : "text",
				type : "get",
				data : {'brand_id':brand_id},
				async:false,
				success:function(res){
					$("#td_a").html(res);
				}
			});
			getGoodsInfo();
		});
		//点击事件--点击价格
		$(document).on("click",".goods_price",function(){
			//alert('123');
			var _this = $(this);

			_this.parent().addClass('nowprice').siblings("li").removeClass('nowprice');

			var goods_price = _this.text();

			$("#brand_price").show();

			$("#brand_price").html(goods_price+"<a id='delgoods_price' goods_price="+goods_price+">×</a>");

			getGoodsInfo();

		});
		//点击事件--点击综合--最新--最热--样式
		$(document).on("click",".default",function(){
			var _this = $(this);
			_this.addClass('active').siblings('li').removeClass('active');
			getGoodsInfo();

		});
		//点击事件--点击分页
		$(document).on("click",".pag",function(){
			var _this = $(this);
			_this.addClass('pages').siblings('a').removeClass('pages');
			getGoodsInfo();
		});
		//重新获取方法
		function getGoodsInfo(){

			var brand_id = $(".logo-list.nowbrand>li").attr('brand_id');

			var goods_price = $(".li.nowprice>a").text();

			var field = $(".default.active").attr("field");

			var p = $(".pag.pages").text();
			$.ajax({
				url:"{{url('/shop/index/list')}}",
				data:{'brand_id':brand_id,'goods_price':goods_price,'field':field,'p':p},
				type:'post',
				dataType:'text',
				async:false,
				success:function(res){
					$("#show").html(res);
				}
			});
		}
		//删除品牌条件
		$(document).on('click',"#delbrand_id",function(){
			var _this = $(this);
			_this.parent().hide();
			var field = $(".default.active").attr("field");
			var p = $(".pag.pages").text();
			var goods_price = $(".li.nowprice>a").text();
			//重新获取此品牌的商品列表
			$.ajax({
				url:"{{url('/shop/index/price/')}}",
				dataType : "text",
				type : "get",
				async:false,
				success:function(res){
					$("#td_a").html(res);
				}
			});
			$.ajax({
				url:"{{url('/shop/index/list')}}",
				data:{'field':field,'p':p,'goods_price':goods_price},
				type:'post',
				dataType:'text',
				async:false,
				success:function(res){
					$("#show").html(res);
				}
			});
		});
		//删除价格条件
		$(document).on('click',"#delgoods_price",function(){
			var _this = $(this);
			_this.parent().hide();
			var field = $(".default.active").attr("field");
			var p = $(".pag.pages").text();
			var brand_id = $(".logo-list.nowbrand>li").attr('brand_id');
			$.ajax({
				url:"{{url('/shop/index/list')}}",
				data:{'field':field,'p':p,'brand_id':brand_id},
				type:'post',
				dataType:'text',
				async:false,
				success:function(res){
					$("#show").html(res);
				}
			});
		})

	})
</script>
</html>