<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>订单详情</title>
     <link rel="icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-seckillOrder.css" />
</head>

<body>
@include('layouts.index.top')
@section('title','新增商品')
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
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
               
                    @include('layouts.index.left')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body">
                        <div class="order-detail">
                            <h4>订单详情</h4>
                            <div class="order-bar">
                                <div class="sui-steps-round steps-round-auto steps-4">
                                    <div class="finished">
                                        <div class="wrap">
                                        <div class="round">1</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>提交订单</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div class="current">
                                        <div class="wrap">
                                        <div class="round">2</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>付款成功</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div class="todo">
                                        <div class="wrap">
                                        <div class="round">3</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>发货</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div class="todo">
                                        <div class="wrap">
                                        <div class="round">4</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>确认收货</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    
                                    <div class="todo last">
                                        <div class="wrap">
                                        <div class="round">5</div>
                                        </div>
                                        <label>
                                            <span>评价晒单</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    </div>
                            </div>
                            <div class="order-state">
                                <p>当前订单状态：<span class="red">已发货</span></p>
                                <p>还剩06天00小时 自动确认收货</p>
                            </div>
                        </div>
                        <div class="order-info">
                            <h5>订单信息</h5>
                            <p>收货地址：神茶减肥茶就观察及噶盘滚啊  </p>
                            <p>订单单号：178789758976986</p>
                            <p>下单时间：2017-06-04 09：03：03</p>
                            <p>支付时间：2017-06-05  09：03：03</p>
                            <p>支付方式：微信</p>
                            <p>发货时间：201707-06-06 09：03：03</p>
                        </div>
                        <div class="order-goods">
                            <table class="sui-table">
                                    <thead>
                                        <th class="center" >商品</th>
                                        <th class="center" >价格</th>
                                        <th class="center" >数量</th>
                                        <th class="center" >优惠</th>
                                        <th class="center" >状态</th>
                                    </thead>                                   
                             
                                <tbody>                               
                                    <tr>
                                        <td colspan="5">订单编号：787587819591509</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="typographic"><img src="/index/static/img/goods.png" />
                                                    <span>包邮 正品玛姬儿压缩面膜无纺布纸膜100粒 送泡瓶面膜刷喷瓶 新款</span>
                                                    <span class="guige">规格：温泉喷雾150ml</span>
                                                </div>
                                        </td>
                                        <td>
                                            <ul class="unstyled">
                                                    <li class="o-price">¥599.00</li>	
                                                    <li>¥299.00</li>											
                                                </ul>
                                        </td>
                                        <td>1</td>
                                        <td>无优惠</td>
                                        <td>交易成功</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="order-price">
                                <p>商品总金额：￥1.8</p>
                                <p>运费金额：，免费用</p>
                                <p>使用优惠券：无</p>
                                <h4 class="red">实际支付：￥1.8</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!--猜你喜欢-->
                        <div class="like-title">
                            <div class="mt">
                                <span class="fl"><strong>热卖单品</strong></span>
                            </div>
                        </div>
                        <div class="like-list">
                            <ul class="yui3-g">
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/index/static/img/_/itemlike01.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>3699.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有6人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/index/static/img/_/itemlike02.png" />
                                        </div>
                                        <div class="attr">
                                            <em>Apple苹果iPhone 6s/6s Plus 16G 64G 128G</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4388.00</i>
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
                                            <img src="/index/static/img/_/itemlike03.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
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
                                            <img src="/index/static/img/_/itemlike04.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
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
        </div>
    </div>
    <!-- 底部栏位 -->
    <!--页面底部-->
      @include('layouts.index.footer')
<!--页面底部END-->
undefined
</html>