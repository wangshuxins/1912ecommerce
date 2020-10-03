<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>我的购物车</title>
    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-cart.css" />
</head>

<body>
@include('layouts.index.navigation')
		<!--All goods-->
		<div class="allgoods">
			<h4>全部商品<span>11</span></h4>
			<div class="cart-main">
				<div class="yui3-g cart-th">
					<div class="yui3-u-1-4"><!-- <input type="checkbox" name="" id="" value="" /> 全部 --></div>
					<div class="yui3-u-1-4">商品</div>
					<div class="yui3-u-1-8">单价（元）</div>
					<div class="yui3-u-1-8">数量</div>
					<div class="yui3-u-1-8">小计（元）</div>
					<div class="yui3-u-1-8">操作</div>
				</div>
				<div class="cart-item-list">
					<div class="cart-body">
						@foreach($car as $k=>$v)
						<div class="cart-list">
							<ul class="goods-list yui3-g" goods_id="{{$v['goods_id']}}">
								<li class="yui3-u-1-24">
									<input type="checkbox" name=""  class="box" value=""  />
								</li>
								<li class="yui3-u-11-24">
									<div class="good-item">
										<div class="item-img"><img  style="width:79px;" src="/{{$v['goods_img']}}" /></div>
										<div class="item-msg">{{$v['goods_name']}}</div>
									</div>
								</li>
								<li class="yui3-u-1-8"><span class="price" id="{{$v['goods_price']}}">{{$v['goods_price']}}</span><font color='red'>.00</font></li>
								{{--cary_id="{{$v['cary_id']}}"--}}
								<li class="yui3-u-1-8"  goods_store="{{$v['goods_store']}}">
									<a href="javascript:void(0)" class="increment mins jian">-</a>
									<input autocomplete="off" type="text"  value="{{$v['buy_number']}}" minnum="1" class="itxt buy_number" />
									<a href="javascript:void(0)" class="increment plus add">+</a>
								</li>

								<li class="yui3-u-1-8"><span class="sum" id="">{{$v['goods_price']*$v['buy_number']}}</span>.00</li>
								{{--ids="{{$v['cary_id']}}"--}}
								<li class="yui3-u-1-8">
									<a class="del">删除</a><br />
									<a href="#none">移到我的关注</a>
								</li>
							</ul>
						</div>
						@endforeach
				</div>
			</div>
			<div class="cart-tool" >
				<div class="select-all">
					<input type="checkbox"  name="" id="allbox" value="" />
					<span>全选</span>
				</div>
				<div class="option">
					<a href="javascript:void(0)" id="delMany">删除选中的商品</a>
					<a href="javascript:void(0)">移到我的关注</a>
					<a href="javascript:void(0)">清除下柜商品</a>
				</div>
				<div class="toolbar">
					<div class="chosed">已选择<span>0</span>件商品</div>
					<div class="sumprice">
						<span><em>总价（不含运费） ：</em><i class="summoney">￥0</i></span>
						<span><em>已节省：</em><i>-¥20.00</i></span>
					</div>
					<div class="sumbtn">
						<a class="sum-btn" id="confirmSettlement"  target="_blank">结算</a>
					</div>
				</div>
			</div>
			{{--<div class="clearfix"></div>--}}
			{{--<div class="deled">--}}
				{{--<span>已删除商品，您可以重新购买或加关注：</span>--}}
				{{--@foreach($resdel as $k=>$v)--}}
				{{--<div class="cart-list del">--}}
					{{--<ul class="goods-list yui3-g">--}}
						{{--<li class="yui3-u-1-2">--}}
							{{--<div class="good-item">--}}
								{{--<div class="item-msg">{{$v->goods_name}}</div>--}}
						{{--</li>--}}
						{{--<li class="yui3-u-1-6"><span class="price">{{$v->goods_price*$v->buy_number}}</span>.00</li>--}}
						{{--<li class="yui3-u-1-6">--}}
							{{--<span class="number">{{$v->buy_number}}</span>--}}
						{{--</li>--}}
						{{--<li class="yui3-u-1-8" idss="{{$v->cary_id}}">--}}
							{{--<a id="chongxin">重新购买</a>--}}
							{{--<a href="#none">移到我的关注</a>--}}
						{{--</li>--}}
					{{--</ul>--}}
				{{--</div>--}}
				{{--@endforeach--}}
			{{--</div>--}}
			<div class="liked">
				<ul class="sui-nav nav-tabs">
					<li class="active">
						<a href="#index" data-toggle="tab">猜你喜欢</a>
					</li>
					<li>
						<a href="#profile" data-toggle="tab">特惠换购</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="tab-content">
					<div id="index" class="tab-pane active">
						<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
							<div class="carousel-inner">
								<div class="active item">
									<ul>
										<li>
											<img src="/index/static/img/like1.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like2.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like3.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like4.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
									</ul>
								</div>
								<div class="item">
									<ul>
										<li>
											<img src="/index/static/img/like1.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like2.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like3.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="/index/static/img/like4.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a>
							<a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
						</div>
					</div>
					<div id="profile" class="tab-pane">
						<p>特惠选购</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部栏位 -->
@include('layouts.index.footer')

<script type="text/javascript" src="/index/static/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/index/static/js/widget/nav.js"></script>
</body>

</html>
<script>
	$(document).ready(function(){
		//点击+号
		$(document).on("click",".add",function(){

			var _this = $(this);

			var buy_number = parseInt(_this.prev("input").val());

			var goods_store = parseInt(_this.parents("li").attr("goods_store"));

			if(buy_number<goods_store){

				buy_number = buy_number+1;
				_this.prev("input").val(buy_number);
			}else{
				_this.prop("disabled",true);return false;
			}
			changeNum(_this,buy_number);
			_this.parents('ul').css('background-color','grey');
			_this.parents("ul").find('.box').prop("checked",true);
			getTotal(_this);
			getMoney();
		});
		//更改购买数量
		function changeNum(_this,buy_number){
			var goods_id = _this.parents("ul").attr("goods_id");
			$.ajax({
				url:"{{url('/shop/buycar/changeNumber')}}",
				data:{'goods_id':goods_id,'buy_number':buy_number},
				type : 'post',
				dataType : 'json',
				async : false,
				success:function(res){
					if(res.error_no==0){
						console.log(res);
					}else{
						alert(res.error_msg);
					}
				}
			});
		}
		//获取小计
		function getTotal(_this){
			var goods_id = _this.parents("ul").attr("goods_id");
			$.ajax({
				url:"{{url('/shop/buycar/getTotal')}}",
				data:{'goods_id':goods_id},
				type : 'post',
				success:function(res){
					_this.parents("li").next().find('.sum').text(res);
				}
			});
		}
		//获取总价
		function getMoney(){
			var _box = $(".box:checked");

			var goods_id = "";
			_box.each(function(index){
				goods_id+=$(this).parents("ul").attr("goods_id")+',';
			});
			goods_id = goods_id.substring(0,goods_id.length-1);
			$.ajax({
				url:"{{url('/shop/buycar/getMoney')}}",
				data:{'goods_id':goods_id},
				type : 'post',
				success:function(res){
					if(res == ''){
						res = '0';
					}
					$(".summoney").text('￥'+res);
				}
			});

		}
		//点击减号
		$(document).on("click",".jian",function(){

			var _this = $(this);

			var buy_number = parseInt(_this.next("input").val());

			var goods_store = parseInt(_this.parents("li").attr("goods_store"));

			if(buy_number>1){

				buy_number = buy_number-1;

				_this.next("input").val(buy_number);

			}else{

				_this.prop("disabled",true);return false;
			}

			changeNum(_this,buy_number);

			_this.parents('ul').css('background-color','grey');
			_this.parents("ul").find('.box').prop("checked",true);
			getTotal(_this);

			getMoney();

		});
		//失去焦点
		$(document).on("blur",".buy_number",function(){

			var _this = $(this);

			var buy_number = parseInt(_this.val());

			var goods_store = parseInt(_this.parents("li").attr("goods_store"));

			//console.log(buy_number);

			if(buy_number==''||parseInt(buy_number)<1||(!/^\d+$/.test(buy_number))){

				_this.val(1);

			}else if(parseInt(buy_number)>goods_store){

				_this.val(goods_store);

			}else{

				_this.val(parseInt(buy_number));

			}
			buy_number = _this.val();
			changeNum(_this,buy_number);

			_this.parents('ul').css('background-color','grey');
			_this.parents("ul").find('.box').prop("checked",true);
			getTotal(_this);
			getMoney();

		});
		//点击复选框
		$(document).on("click",".box",function(){

			var _this = $(this);

			var status = _this.prop('checked');
			if(status == true){
				_this.parents('ul').css('background-color','grey');
			}else{
				_this.parents('ul').css('background-color','');
			}
			getMoney();
		});
		//点击全选
		$(document).on("click","#allbox",function(){
			//alert('5');
			var status = $("#allbox").prop("checked");
			$(".box").prop("checked",status);
			if(status == true){

				$(".box").parents('ul').css('background-color','grey');

			}else{

				$(".box").parents('ul').css('background-color','');
			}

			getMoney();

		});
		//点击删除
		$(document).on("click",".del",function(){
			//alert('6');
			var _this = $(this);
			var goods_id = _this.parents("ul").attr("goods_id");
			$.ajax({
				url:"{{url('/shop/car/del')}}",
				data:{'goods_id':goods_id},
				type : 'post',
				dataType : 'json',
				success:function(res){
					if(res.error_no==0){
						_this.parents("ul").remove();
						getMoney();
					}else{
						alert(res.error_msg);
					}
				}
			});
		});
		//删除选中的商品
		$(document).on("click","#delMany",function(){
			var _this = $(this);
			//alert('7');
			var _box = $(".box:checked");
			//console.log(_box);return false;
			var goods_id = "";
			_box.each(function(index){
				goods_id+=$(this).parents("ul").attr("goods_id")+',';
			});
			//console.log(goods_id);return false;
			goods_id = goods_id.substring(0,goods_id.length-1);
			//console.log(goods_id);return false;
			$.ajax({

				url:"{{url('/shop/buycar/carDel')}}",

				data:{'goods_id':goods_id},

				type : 'post',

				dataType : 'json',

				success:function(res){
					if(res.error_no==0){
						_box.each(function(index){
							$(this).parents("ul").remove();
						});
						getMoney();
					}else{
						alert(res.error_msg);
					}
				}
			});
		});
		//点击确结算
		$(document).on("click","#confirmSettlement",function(){
			var _box = $(".box:checked");

			if(_box.length==0){
				alert("请选择要进行结算的商品");return false;
			}
			var goods_id = "";
			_box.each(function(index){
				goods_id+=$(this).parents("ul").attr("goods_id")+',';
			});
			//console.log(goods_id);return false;
			goods_id = goods_id.substring(0,goods_id.length-1);
			//console.log(goods_id);return false;
			location.href ="/shop/getorderinfo/"+goods_id;
		});

	});
</script>
