<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，优质！优质！</title>
	<link rel="icon" href="assets/img/favicon.ico">

	<link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="/index/static/css/pages-JD-index.css" />
	<link rel="stylesheet" type="text/css" href="/index/static/css/widget-jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="/index/static/css/widget-cartPanelView.css" />
</head>

<body>
@include('layouts.index.top')
<div class="sort">
	<div class="py-container">
		<div class="yui3-g SortList ">
			<div class="yui3-u Left all-sort-list">
				<div class="all-sort-list2">
					@foreach($quanbu as $v)
						<div class="item bo">
							<h3><a href="{{url('/shop/search/'.$v['cate_id'])}}">{{$v['cate_name']}}</a></h3>
							<div class="item-list clearfix">
								<div class="subitem">
									@foreach($v['child'] as $vv)
										<dl class="fore1">
											<dt><a href="{{url('/shop/search/'.$vv['cate_id'])}}">{{$vv['cate_name']}}</a></dt>

											<dd>
												@foreach($vv['child'] as $vvv)
													<em><a href="{{url('/shop/search/'.$vvv['cate_id'])}}">{{$vvv['cate_name']}}</a></em>
												@endforeach
											</dd>

										</dl>
									@endforeach

								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<div class="yui3-u Center banerArea">
				<!--banner轮播-->
				<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
					<ol class="carousel-indicators">
						@foreach($luenbutu as $k=>$v)
							@if($k==0)
								<li data-target="#myCarousel" data-slide-to="{{$k}}" class="active"></li>
							@else
								<li data-target="#myCarousel" data-slide-to="{{$k}}"></li>
							@endif

						@endforeach

					</ol>
					<div class="carousel-inner">
						@foreach($luenbutu as $k=>$v)
							@if($k==0)
								<div class="active item">
									<a href="{{url('/shop/item/'.$v->url)}}">
										<img style="width:746px;height:456px" src="../{{$v->img_path}}"  />
									</a>
								</div>
							@else
								<div class="item" >
									<a href="{{url('/shop/item/'.$v->url)}}">
										<img style="width:746px;height:456px" src="../{{$v->img_path}}"  />
									</a>
								</div>
							@endif
						@endforeach
					</div><a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a><a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
				</div>
			</div>
			<div class="yui3-u Right">
				<div class="news">
					<h4><em class="fl">品优购快报</em><span class="fr tip">更多 ></span></h4>
					<div class="clearix"></div>
					<ul class="news-list unstyled">
						@foreach($guanggao as $k=>$v)
							<li>
								<span class="bold"><a style="text-decoration:none"    href="{{url('/shop/item/'.$v->ad_url)}}"><font color='black'>{{$v->ad_name}}</font></a></span>
							</li>
							@endforeach
									<!-- 		<li>
								<span class="bold">[公告]</span>备战开学季 全民半价购数码
							</li>
							<li>
								<span class="bold">[特惠]</span>备战开学季 全民半价购数码
							</li>
							<li>
								<span class="bold">[公告]</span>备战开学季 全民半价购数码
							</li>
							<li>
								<span class="bold">[特惠]</span>备战开学季 全民半价购数码
							</li> -->
					</ul>
				</div>
				<ul class="yui3-g Lifeservice">
					<li class="yui3-u-1-4 life-item tab-item">
						<i class="list-item list-item-1"></i>
						<span class="service-intro">话费</span>
					</li>
					<li class="yui3-u-1-4 life-item tab-item">
						<i class="list-item list-item-2"></i>
						<span class="service-intro">机票</span>
					</li>
					<li class="yui3-u-1-4 life-item tab-item">
						<i class="list-item list-item-3"></i>
						<span class="service-intro">电影票</span>
					</li>
					<li class="yui3-u-1-4 life-item tab-item">
						<i class="list-item list-item-4"></i>
						<span class="service-intro">游戏</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-5"></i>
						<span class="service-intro">彩票</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-6"></i>
						<span class="service-intro">加油站</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-7"></i>
						<span class="service-intro">酒店</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-8"></i>
						<span class="service-intro">火车票</span>
					</li>
					<li class="yui3-u-1-4 life-item  notab-item">
						<i class="list-item list-item-9"></i>
						<span class="service-intro">众筹</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-10"></i>
						<span class="service-intro">理财</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-11"></i>
						<span class="service-intro">礼品卡</span>
					</li>
					<li class="yui3-u-1-4 life-item notab-item">
						<i class="list-item list-item-12"></i>
						<span class="service-intro">白条</span>
					</li>
				</ul>
				<div class="life-item-content">
					<div class="life-detail">
						<i class="close">关闭</i>
						<p>话费充值</p>
						<form action="" class="sui-form form-horizontal">
							号码：<input type="text" id="inputphoneNumber" placeholder="输入你的号码" />
						</form>
						<button class="sui-btn btn-danger">快速充值</button>
					</div>
					<div class="life-detail">
						<i class="close">关闭</i> 机票
					</div>
					<div class="life-detail">
						<i class="close">关闭</i> 电影票
					</div>
					<div class="life-detail">
						<i class="close">关闭</i> 游戏
					</div>
				</div>
				<div class="ads">
					<img src="/index/static/img/ad1.png" />
				</div>
			</div>
		</div>
	</div>
</div>
<!--推荐-->
<div class="show">
	<div class="py-container">
		<ul class="yui3-g Recommend">
			<li class="yui3-u-1-6  clock">
				<div class="time">
					<img src="/index/static/img/clock.png" />
					<h3>今日推荐</h3>
				</div>
			</li>
			<li class="yui3-u-5-24">
				<a href="list.html" target="_blank"><img src="/index/static/img/today01.png" /></a>
			</li>
			<li class="yui3-u-5-24">
				<img src="/index/static/img/today02.png" />
			</li>
			<li class="yui3-u-5-24">
				<img src="/index/static/img/today03.png" />
			</li>
			<li class="yui3-u-5-24">
				<img src="/index/static/img/today04.png" />
			</li>
		</ul>
	</div>
</div>
<!--喜欢-->
<div class="like">
	<div class="py-container">
		<div class="title">
			<h3 class="fl">猜你喜欢</h3>
			<b class="border"></b>
			<a href="javascript:;" class="fr tip changeBnt" id="xxlChg"><i></i>换一换</a>
		</div>
		<div class="bd">
			<ul class="clearfix yui3-g Favourate picLB" id="picLBxxl">
				<li class="yui3-u-1-6">
					<dl class="picDl huozhe">
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>阳光美包新款单肩包女包时尚子母包四件套女</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_01.png" alt="" /></a>
							<div class="like-text">
								<p>爱仕达 30CM炒锅不粘锅NWG8330E电磁炉炒</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
					</dl>
				</li>
				<li class="yui3-u-1-6">
					<dl class="picDl jilu">
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_03.png" alt="" /></a>
							<div class="like-text">
								<p>爱仕达 30CM炒锅不粘锅NWG8330E电磁炉炒</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>阳光美包新款单肩包女包时尚子母包四件套女</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
					</dl>
				</li>
				<li class="yui3-u-1-6">
					<dl class="picDl tuhua">
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_01.png" alt="" /></a>
							<div class="like-text">
								<p>捷波朗 </p>
								<p>（jabra）BOOSI劲步</p>
								<h3>¥236.00</h3>
							</div>
						</dd>
						<dd>
							<a href="" class="pic"><img nsrc="assets//index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>三星（G5500）</p>
								<p>移动联通双网通</p>
								<h3>¥566.00</h3>
							</div>
						</dd>
					</dl>
				</li>
				<li class="yui3-u-1-6">
					<dl class="picDl huozhe">
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>阳光美包新款单肩包女包时尚子母包四件套女</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
						<dd>
							<a href="" class="pic"><img src="/index/static/img/like_01.png" alt="" /></a>
							<div class="like-text">
								<p>爱仕达 30CM炒锅不粘锅NWG8330E电磁炉炒</p>
								<h3>¥116.00</h3>
							</div>
						</dd>
					</dl>
				</li>
				<li class="yui3-u-1-6">
					<dl class="picDl jilu">
						<dd>
							<a href="http://sc.chinaz.com/" class="pic"><img src="/index/static/img/like_03.png" alt="" /></a>
							<div class="like-text">
								<p>捷波朗 </p>
								<p>（jabra）BOOSI劲步</p>
								<h3>¥236.00</h3>
							</div>
						</dd>
						<dd>
							<a href="http://sc.chinaz.com/" class="pic"><img src="/index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>欧普</p>
								<p>JYLZ08面板灯平板灯铝</p>
								<h3>¥456.00</h3>
							</div>
						</dd>
					</dl>
				</li>
				<li class="yui3-u-1-6">
					<dl class="picDl tuhua">
						<dd>
							<a href="http://sc.chinaz.com/" class="pic"><img src="/index/static/img/like_01.png" alt="" /></a>
							<div class="like-text">
								<p>三星（G5500）</p>
								<p>移动联通双网通</p>
								<h3>¥566.00</h3>
							</div>
						</dd>
						<dd>
							<a href="http://sc.chinaz.com/" class="pic"><img nsrc="assets//index/static/img/like_02.png" alt="" /></a>
							<div class="like-text">
								<p>韩国所望紧致湿润精华露400ml</p>
								<h3>¥896.00</h3>
							</div>
						</dd>
					</dl>
				</li>
			</ul>
		</div>
	</div>
</div>
<!--有趣-->
<div class="fun">
	<div class="py-container">
		<div class="title">
			<h3 class="fl">传智播客.有趣区</h3>
		</div>
		<div class="clearfix yui3-g Interest">
			<span class="x-line"></span>
			<div class="yui3-u row-405 Interest-conver">
				<img src="/index/static/img/interest01.png" />
			</div>
			<div class="yui3-u row-225 Interest-conver-split">
				<h5>好东西</h5>
				<img src="/index/static/img/interest02.png" />
				<img src="/index/static/img/interest03.png" />
			</div>
			<div class="yui3-u row-405 Interest-conver-split blockgary">
				<h5>品牌街</h5>
				<div class="split-bt">
					<img src="/index/static/img/interest04.png" />
				</div>
				<div class="x-img fl">
					<img src="/index/static/img/interest05.png" />
				</div>
				<div class="x-img fr">
					<img src="/index/static/img/interest06.png" />
				</div>
			</div>
			<div class="yui3-u row-165 brandArea">
				<span class="brand-yline"></span>
				<ul class="yui3-g brand-list">
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand01.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand02.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand03.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand04.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand05.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand06.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand07.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand08.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand09.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand10.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand11.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand12.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand13.png" /></li>
					<li class="yui3-u-1-2 brand-pit"><img src="/index/static/img/brand03.png" /></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--楼层-->


@foreach($manContent as $v)
	<div id="floor-1" class="floor">
		<div class="py-container">
			<div class="title floors" id="lei">
				<h3 class="fl">{{$v['cate_name']}}</h3>
				<div 	class="fr">    <!--  类 -->
					<ul class="sui-nav nav-tabs">

						@foreach($v['child'] as $k=>$vv)

							<li id="ajax" ids="{{$vv['cate_id']}}"><a href="#tab{{$vv['cate_id']}}" data-toggle="tab">{{$vv['cate_name']}}</a></li>


						@endforeach
					</ul>
				</div>
			</div>

			<div class="clearfix  tab-content floor-content">

				@foreach($v['child'] as $k=> $vv)

					<div id="tab{{$vv['cate_id']}}" class="tab-pane ">   <!-- active -->

						<!-- 				<div class="yui3-g Floor-1">
						<div class="yui3-u Left blockgary">
							<ul class="jd-list">
								@foreach($vv['child']  as $vvv)
								<li>{{$vvv['cate_name']}}</li>
								@endforeach
								</ul>
                            </div>

                            <div class="yui3-u row-220 split">
                                <span class="floor-x-line"></span>
                                <div class="floor-conver-pit">
                                    <img src="/index/static/img/floor-1-2.png" />
                                </div>
                                <div class="floor-conver-pit">
                                    <img src="/index/static/img/floor-1-3.png" />
                                </div>
                            </div>

                        </div> -->
					</div>
				@endforeach
			</div>

		</div>
	</div>
	@endforeach


			<!--商标-->
	<div class="brand">
		<div class="py-container">
			<ul class="Brand-list blockgary">
				<li class="Brand-item">
					<img src="/index/static/img/brand_21.png" />
				</li>
				<li class="Brand-item"><img src="/index/static/img/brand_03.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_05.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_07.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_09.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_11.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_13.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_15.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_17.png" /></li>
				<li class="Brand-item"><img src="/index/static/img/brand_19.png" /></li>
			</ul>
		</div>
	</div>
	<!-- 底部栏位 -->
	<!--页面底部-->
	@include('layouts.index.footer')
			<!--页面底部END-->
	<!-- 楼层位置 -->
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
					<div onclick="cartPanelView.tabItemClick('cart')" class="toolbar-tab tbar-tab-cart" data="购物车" tag="cart" >
						<i class="tab-ico"></i>
						<em class="tab-text"></em>
						<span class="tab-sub J-count " id="tab-sub-cart-count">0</span>
					</div>
					<div onclick="cartPanelView.tabItemClick('follow')" class="toolbar-tab tbar-tab-follow" data="我的关注" tag="follow" >
						<i class="tab-ico"></i>
						<em class="tab-text"></em>
						<span class="tab-sub J-count hide">0</span>
					</div>
					<div onclick="cartPanelView.tabItemClick('history')" class="toolbar-tab tbar-tab-history" data="我的足迹" tag="history" >
						<i class="tab-ico"></i>
						<em class="tab-text"></em>
						<span class="tab-sub J-count hide">0</span>
					</div>
				</div>

				<div class="toolbar-footer">
					<div class="toolbar-tab tbar-tab-top" > <a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a> </div>
					<div class="toolbar-tab tbar-tab-feedback" > <a href="#" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a> </div>
				</div>

				<div class="toolbar-mini"></div>

			</div>

			<div id="J-toolbar-load-hook"></div>

		</div>
	</div>
	<!--购物车单元格 模板-->
	<script type="text/template" id="tbar-cart-item-template">
		<div class="tbar-cart-item" >
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
	<script type="text/javascript" src="/index/static/js/model/cartModel.js"></script>
	<script type="text/javascript" src="/index/static/js/czFunction.js"></script>
	<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
	<script type="text/javascript" src="/index/static/js/pages/index.js"></script>
	<script type="text/javascript" src="/index/static/js/widget/cartPanelView.js"></script>
	<script type="text/javascript" src="/index/static/js/widget/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/index/static/js/widget/nav.js"></script>
</body>


</html>
<script>
	$(document).ready(function(){

		$(document).on("click","#ajax",function(){
			var cate_id=$(this).attr("ids");
			var _this=$(this);
			// alert(cate_id);
			//  标识

			$.ajax({
				url:"{{url('/')}}",
				data:{cate_id:cate_id},
				type:"get",
				dataType:'text',
				success:function(res){
					//	alert(res);
					//.find("div")
					_this.parents("#lei").next().html(res);
				}
			})
		})
	});
</script>