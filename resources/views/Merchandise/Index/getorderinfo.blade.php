<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>结算页</title>
    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-getOrderInfo.css" />
</head>
<body>
<!--head-->
@include('layouts.index.navigation')
<!--主内容-->
<div class="checkout py-container">
<div class="checkout-tit">
	<h4 class="tit-txt">填写并核对订单信息</h4>
</div>
<div class="checkout-steps">
<!--收件人信息-->
<div class="step-tit">	
	<h5>收件人信息<span><a href="{{url('/shop/homesettingaddress')}}">新增收货地址</a></span></h5>
</div>
<div class="step-cont">
	<div class="addressInfo">
		<ul class="addr-detail">
			<li class="addr-item">
			@foreach($rderdata as $k=>$a)
			@if($a['is_default'] == 2)
			<div>
				<div class="con name"  attr_id="{{$a['id']}}"><a href="javascript:;" >{{$a["user_name"]}}<span title="点击取消选择">&nbsp;</a></div>
				<div class="con address">{{$a['province']}}-{{$a['city']}}-{{$a['area']}} {{$a["paddress"]}} <span>{{$a['tel']}}</span>
				<span class="base">@if($a['is_default'] == 2) 默认收货 @endif</span>
				<span class="edittext"><a href="{{url('/shop/homesettingaddress')}}">编辑</a>&nbsp;&nbsp;<a href="{{url('/shop/homesettingaddress')}}">删除</a></span>
			</div>
				<div class="clearfix"></div>
			</div>
			 @endif
			@endforeach
			</li>
		</ul>
<!--确认地址-->
</div>
	<div class="hr"></div>
</div>
	<div class="hr"></div>
	<!--支付和送货-->
	<div class="payshipInfo">
		<div class="step-tit">
			<h5>支付方式</h5>
		</div>
		<div class="step-cont">
			<ul class="payType">
				<li id="payname" payname="1">支付宝支付</li>
				<li id="payname" payname="2">微信支付</li>
			</ul>
		</div>
	<div class="hr"></div>
	<div class="step-tit">
		<h5>送货清单</h5>
	</div>
<div class="step-cont">
	<ul class="send-detail">
		<li>
		<div class="sendGoods">	
			@foreach($goods_name as $k=>$a)						
			<ul class="yui3-g">
				<li class="yui3-u-1-6">
					<span><img src="/../{{$a['goods_img']}}"/></span>
				</li>
				<li class="yui3-u-7-12">
					<div class="desc" goods_id="{{$a['goods_id']}}">{{$a["goods_name"]}}</div>
					<div class="seven">7天无理由退货</div>
				</li>
				<li class="yui3-u-1-12">
					<div class="price">￥<span class="unit_price" attr_id="{{$a['goods_totall']}}">{{$a["goods_totall"]}}</span></div>
				</li>
				<li class="yui3-u-1-12">
					<div class="num">X{{$a["buy_number"]}}</div>
				</li>
				<li class="yui3-u-1-12">
					<div class="exit">@if($a["goods_score"] > $a["buy_number"]) 有货 @else 没货 @endif</div>
				</li>
			</ul>
			@endforeach
	</div>
			</li>
			<li></li>
			<li></li>
		</ul>
	</div>
		<div class="hr"></div>
	</div>
<!-- 	<div class="linkInfo">
		<div class="step-tit">
			<h5>发票信息</h5>
		</div>
	<div class="step-cont">
		<span>普通发票（电子）</span>
		<span>个人</span>
		<span>明细</span>
	</div>
	</div> -->
<!-- 	<div class="cardInfo">
		<div class="step-tit">
			<h5>使用优惠/抵用</h5>
		</div>
	</div> -->
</div>
</div>
		<div class="order-summary">
			<div class="static fr">
				<div class="list">
					<span><i class="number">1</i>件商品，总商品金额</span>
					<em class="allprice">¥{{$unit_price}}</em>
				</div>
				<div class="list">
					<span>返现：</span>
					<em class="money">0.00</em>
				</div>
				<div class="list">
					<span>运费：</span>
					<em class="transport">0.00</em>
				</div>
			</div>
		</div>
		<div class="clearfix trade">
			<div class="fc-price">应付金额:　<span class="price" id="total_price" total_pr="{{$unit_price}}">¥{{$unit_price}}</span></div>
			<!-- <div class="fc-receiverInfo">寄送至:北京市海淀区三环内 中关村软件园9号楼 收货人：某某某 159****3201</div>-->
		</div>
		<div class="submit">
			<a class="sui-btn btn-danger btn-xlarge" href="javascript:;">提交订单</a>
		</div>
	</div>
	<!-- 底部栏位 -->
	<!--页面底部-->
<div class="clearfix footer">
	<div class="py-container">
		<div class="footlink">
			<div class="Mod-service">
				<ul class="Mod-Service-list">
					<li class="grid-service-item intro  intro1">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro2">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro  intro3">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro4">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro intro5">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
				</ul>
			</div>
			<div class="clearfix Mod-list">
				<div class="yui3-g">
					<div class="yui3-u-1-6">
						<h4>购物指南</h4>
						<ul class="unstyled">
							<li>购物流程</li>
							<li>会员介绍</li>
							<li>生活旅行/团购</li>
							<li>常见问题</li>
							<li>购物指南</li>
						</ul>

					</div>
					<div class="yui3-u-1-6">
						<h4>配送方式</h4>
						<ul class="unstyled">
							<li>上门自提</li>
							<li>211限时达</li>
							<li>配送服务查询</li>
							<li>配送费收取标准</li>
							<li>海外配送</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>支付方式</h4>
						<ul class="unstyled">
							<li>货到付款</li>
							<li>在线支付</li>
							<li>分期付款</li>
							<li>邮局汇款</li>
							<li>公司转账</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>售后服务</h4>
						<ul class="unstyled">
							<li>售后政策</li>
							<li>价格保护</li>
							<li>退款说明</li>
							<li>返修/退换货</li>
							<li>取消订单</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>特色服务</h4>
						<ul class="unstyled">
							<li>夺宝岛</li>
							<li>DIY装机</li>
							<li>延保服务</li>
							<li>品优购E卡</li>
							<li>品优购通信</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>帮助中心</h4>
						<img src="/index/static/img/wx_cz.jpg">
					</div>
				</div>
			</div>
			<div class="Mod-copyright">
				<ul class="helpLink">
					<li>关于我们<span class="space"></span></li>
					<li>联系我们<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>商家入驻<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们</li>
				</ul>
				<p>地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</p>
				<p>京ICP备08001421号京公网安备110108007702</p>
			</div>
		</div>
	</div>
</div>
<!--页面底部END-->
<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/index/static/js/widget/nav-portal-top.js"></script>
<script type="text/javascript" src="/index/static/js/pages/getOrderInfo.js"></script>
</body>
</html>
<script>
$(function(){
		//收货地址
		// $(".name").click(function(){
		// 	var data = $(this).attr("attr_id");
		// 	var url="/shop/orderaddress";
		// 	$.ajax({
		// 		url:url,
		// 		type:'post',
		// 		data:{data:data},
		// 		async:true,
		// 		success:function(index){
		// 			console.log(index);
		// 			$(".fc-receiverInfo").html("寄送至:北京市海淀区三环内 中关村软件园9号楼 收货人：某某某 159****3201");
		// 		}
		// 	});
		// });{{url('/shop/pay')}}
	$(".btn-xlarge").click(function(){
		var cary_id = $(".name.selected").attr("attr_id");
		if(cary_id == undefined){
			alert("请选择收货地址");
			return false;
		}
		var payname = $("#payname.selected").attr("payname");  
		if(payname == undefined){
			alert("请选择支付方式");
			return false;
		}
		var total_price = $("#total_price").attr("total_pr");
		if(total_price == undefined){
			alert("页面错误");
			return false;
		}
		var goods_id = [];
        $('.desc').each(function(){
            goods_id.push($(this).attr("goods_id"));
        });
        if(goods_id==''){
            return;
        }
        var url = "/shop/orderaddress";
		$.ajax({
			url:url,
			type:'post',
			data:{goods_id:goods_id,cary_id:cary_id,payname:payname,total_price:total_price},
			async:true,
			success:function(index){
				location.href=("/shop/pay");
			}
		});	
	});




});
</script>