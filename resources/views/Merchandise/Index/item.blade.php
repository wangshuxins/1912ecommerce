	    <!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>产品详情页</title>
    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-item.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-zoom.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/widget-cartPanelView.css" />
</head>
<body>
	@include('layouts.index.top')
	<div class="py-container">
		<div id="item">
			<div class="crumb-wrap">
				<ul class="sui-breadcrumb">
					<li>
						<a href="#">手机、数码、通讯</a>
					</li>
					<li>
						<a href="#">手机</a>
					</li>
					<li>
						<a href="#">Apple苹果</a>
					</li>
					<li class="active">iphone 6S系类</li>
				</ul>
			</div>
			<!--product-info-->
			@foreach($goods as $v)
			<div class="product-info">
				<div class="fl preview-wrap">
					<!--放大镜效果-->
					<div class="zoom">
						<!--默认第一个预览-->
						<div id="preview" class="spec-preview">
							<span class="jqzoom"><img  width="410" jqimg="/{{$v->goods_img}}" bimg="/{{$v->goods_img}}" src="/{{$v->goods_img}}" /></span>
						</div>
						<!--下方的缩略图-->
						<div class="spec-scroll">
							<a class="prev">&lt;</a>
							<!--左右按钮-->
							<div class="items">
								<ul>
									<!-- 相册 -->
									@if($v->goods_imgs)
												  @php $imgarr = explode(',',$v->goods_imgs);@endphp
												  @foreach($imgarr as $img)
											<li><img src="/{{$img}}" bimg="/{{$img}}" onmousemove="preview(this)" /></li>

												  @endforeach
											  @endif
									
									<!-- 相册 -->
								</ul>
							</div>
							<a class="next">&gt;</a>
						</div>
					</div>
				</div>
				<div class="fr itemInfo-wrap">
					<div class="sku-name" goods_id="{{$v->goods_id}}">
						<h4>{{$v->goods_name}}</h4>
					</div>
					<div class="news"><span>推荐选择下方[移动优惠购],手机套餐齐搞定,不用换号,每月还有花费返</span></div>
					<div class="summary">
						<div class="summary-wrap">
							<div class="fl title">
								<i>价　　格</i>
							</div>
							<div class="fl price">
								<i>¥</i>
								<em id="goods_price" ids="{{$v->goods_price}}">{{$v->goods_price}}</em>
								<!-- <span>降价通知</span> -->
							</div>
							<div class="fr remark">
								<i>库存</i><em id="goods_store">{{$v->goods_store}}</em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<!-- <i>促　　销</i> -->
							</div>
							<div class="fl fix-width">
							<!-- 	<i class="red-bg">加价购</i>
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em> -->
							</div>
						</div>
					</div>
					<div class="support">
						<div class="summary-wrap">
							<div class="fl title">
								<i>支　　持</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">以旧换新，闲置手机回收  4G套餐超值抢  礼品购</em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>配 送 至</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
							</div>
						</div>
					</div>
					<div class="clearfix choose">
						<div id="specification" class="summary-wrap clearfix">
							@foreach($Attr as $k=>$a)
							<dl>
								<dt>
									<div class="fl title" id="attr">
										<i class="attr_name">{{$a["attr_name"]}}</i>
									</div>
								</dt>
								<!--  class="selected" -->
								<!-- <dd><a href="javascript:;">金色<span title="点击取消选择">&nbsp;</span></a></dd> -->
								<dt>
								@foreach($attrval as $key=>$val)
								@if($val["attr_id"] == $a['id'])
								<dd>
									<a href="javascript:;" class="see val_id" attr_id="{{$val['attr_id']}}" value="{{$val['id']}}">
										{{$val["attrval_name"]}}
										<span title="点击取消选择">&nbsp;</span>
									</a>
								</dd>
								@endif
								@endforeach
								</dt>
							</dl>	
							@endforeach
						</div>
						<div class="summary-wrap">
							@if(session("users"))
						@if($is_collect==1)
							<span id="collect">收藏</span>
							@else
							<span id="collect">已收藏</span>
							@endif
							@else
								<span id="nocollect">收藏</span>
                            @endif
							<div class="fl title">
								<div class="control-group">
									<div class="controls">
										<input autocomplete="off" type="text" value="1" minnum="1" class="itxt" />
										<a href="javascript:void(0)" class="increment plus">+</a>
										<a href="javascript:void(0)" class="increment mins">-</a>
									</div>
								</div>
							</div>
							<div class="fl">
								<ul class="btn-choose unstyled">
									<li>							
									<p target="_blank"   id="{{$v->goods_id}}" class="sui-btn  btn-danger addshopcar submit">加入购物车</p>
									<p id="submitdescde">加入购物车</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!--product-detail-->
			<div class="clearfix product-detail">
				<div class="fl aside">
					<ul class="sui-nav nav-tabs tab-wraped">
						<li class="active">
							<a href="#index" data-toggle="tab">
								<span>相关分类</span>
							</a>
						</li>
						<li>
							<a href="#profile" data-toggle="tab">
								<span>推荐品牌</span>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane active">
							<ul class="part-list unstyled">
								<li>手机</li>
								<li>手机壳</li>
								<li>内存卡</li>
								<li>Iphone配件</li>
								<li>贴膜</li>
								<li>手机耳机</li>
								<li>移动电源</li>
								<li>平板电脑</li>
							</ul>
							<ul class="goods-list unstyled">
								<li>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/index/static/img/_/part01.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="{{url('/shop/cart')}}" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
								</li>
								<li>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/index/static/img/_/part02.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="{{url('/shop/cart')}}" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
								</li>
								<li>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/index/static/img/_/part03.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="{{url('/shop/cart')}}" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/index/static/img/_/part02.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="{{url('/shop/cart')}}" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/index/static/img/_/part03.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="{{url('/shop/cart')}}" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div id="profile" class="tab-pane">
							<p>推荐品牌</p>
						</div>
					</div>
				</div>
				<div class="fr detail">
					<div class="clearfix fitting">
						<h4 class="kt">选择搭配</h4>
						<div class="good-suits">
							<div class="fl master">
								<div class="list-wrap">
									<div class="p-img">
										<img src="/index/static/img/_/l-m01.png" />
									</div>
									<em>￥5299</em>
									<i>+</i>
								</div>
							</div>
							<div class="fl suits">
								<ul class="suit-list">
									<li class="">
										<div id="">
											<img src="/index/static/img/_/dp01.png" />
										</div>
										<i>Feless费勒斯VR</i>
										<label data-toggle="checkbox" class="checkbox-pretty">
    <input type="checkbox"><span>39</span>
  </label>
									</li>
									<li class="">
										<div id=""><img src="/index/static/img/_/dp02.png" /> </div>
										<i>Feless费勒斯VR</i>
										<label data-toggle="checkbox" class="checkbox-pretty">
    <input type="checkbox"><span>50</span>
  </label>
									</li>
									<li class="">
										<div id=""><img src="/index/static/img/_/dp03.png" /></div>
										<i>Feless费勒斯VR</i>
										<label data-toggle="checkbox" class="checkbox-pretty">
    <input type="checkbox"><span>59</span>
  </label>
									</li>
									<li class="">
										<div id=""><img src="/index/static/img/_/dp04.png" /></div>
										<i>Feless费勒斯VR</i>
										<label data-toggle="checkbox" class="checkbox-pretty">
    <input type="checkbox"><span>99</span>
  </label>
									</li>
								</ul>
							</div>
							<div class="fr result">
								<div class="num">已选购0件商品</div>
								<div class="price-tit"><strong>套餐价</strong></div>
								<div class="price">￥5299</div>
								<button class="sui-btn  btn-danger addshopcar"><a href="{{url('/shop/cart')}}">加入购物车</a></button>
							</div>
						</div>
					</div>
					<div class="tab-main intro">
						<ul class="sui-nav nav-tabs tab-wraped">
							<li class="active">
								<a href="#one" data-toggle="tab">
									<span>商品介绍</span>
								</a>
							</li>
							<li>
								<a href="#two" data-toggle="tab">
									<span>规格与包装</span>
								</a>
							</li>
							<li>
								<a href="#three" data-toggle="tab">
									<span>售后保障</span>
								</a>
							</li>
							<li>
								<a href="#four" data-toggle="tab">
									<span>商品评价</span>
								</a>
							</li>
							<li>
								<a href="#five" data-toggle="tab">
									<span>手机社区</span>
								</a>
							</li>
						</ul>
						<div class="clearfix"></div>
						<div class="tab-content tab-wraped">
							<div id="one" class="tab-pane active">
								<ul class="goods-intro unstyled">
									<li>分辨率：1920*1080(FHD)</li>
									<li>后置摄像头：1200万像素</li>
									<li>前置摄像头：500万像素</li>
									<li>核 数：其他</li>
									<li>频 率：以官网信息为准</li>
									<li>品牌： Apple</li>
									<li>商品名称：APPLEiPhone 6s Plus</li>
									<li>商品编号：1861098</li>
									<li>商品毛重：0.51kg</li>
									<li>商品产地：中国大陆</li>
									<li>热点：指纹识别，Apple Pay，金属机身，拍照神器</li>
									<li>系统：苹果（IOS）</li>
									<li>像素：1000-1600万</li>
									<li>机身内存：64GB</li>
								</ul>
								<div class="intro-detail">
									<img src="/index/static/img/_/intro01.png" />
									<img src="/index/static/img/_/intro02.png" />
									<img src="/index/static/img/_/intro03.png" />
								</div>
							</div>
							<div id="two" class="tab-pane">
								<p>规格与包装</p>
							</div>
							<div id="three" class="tab-pane">
								<p>售后保障</p>
							</div>
							<div id="four" class="tab-pane">
								<p>商品评价</p>
							</div>
							<div id="five" class="tab-pane">
								<p>手机社区</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--like-->
			<div class="clearfix"></div>
			<div class="like">
				<h4 class="kt">猜你喜欢</h4>
				<div class="like-list">
					<ul class="yui3-g">
						<li class="yui3-u-1-6">
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
						<li class="yui3-u-1-6">
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
						<li class="yui3-u-1-6">
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
						<li class="yui3-u-1-6">
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
						<li class="yui3-u-1-6">
							<div class="list-wrap">
								<div class="p-img">
									<img src="/index/static/img/_/itemlike05.png" />
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
						<li class="yui3-u-1-6">
							<div class="list-wrap">
								<div class="p-img">
									<img src="/index/static/img/_/itemlike06.png" />
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
	<!-- 底部栏位 -->
		@include('layouts.index.footer')
	</body>
</html>
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
	<script type="text/javascript" src="/index/static/js/plugins/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/index/static/js/plugins/sui/sui.min.js"></script>
	<script type="text/javascript" src="/index/static/js/plugins/jquery.jqzoom/jquery.jqzoom.js"></script>
	<script type="text/javascript" src="/index/static/js/plugins/jquery.jqzoom/zoom.js"></script>
	<script type="text/javascript" src="/index/static/js/pages/index.js"></script>
</body>
</html>
<script>
	// $(document).ready(function(){
	// 	$(document).find("#specification").find("dl:first").each();
	// });

	$(document).ready(function(){
		$(".submit").hide();
//————————————————————————添加样式————————————————————————————————————//
	$(document).on("click",".see",function(){
		//属性id
		var attr_id = $(this).attr("attr_id");
		var attr_val = $("#val_id").val();
		// alert(attr_val);

		//属性值id
		var attr_val = $(this).attr("value");
		//商品id
		var goods_id = $(".sku-name").attr("goods_id");
		//alert(goods_id);
		//样式
		 $(this).addClass("selected").append("<span title='点击取消选择'>&nbsp;</span>");
         var add = $(this).parent().siblings().children().removeClass("selected");
         var str = new Array();
         $(".selected").each(function(){
         	str.push($(this).attr("attr_id")+","+$(this).attr("value"));
         })
         //计算长度是否全部选中
		 var selected = $(".selected").length;
		 //alert(selected);
		 var attr_name = $(".attr_name").length;
		 //alert(attr_name);
		 if(selected==attr_name){
		 	var data = {attr_id:str,goods_id:goods_id};
		 	var url = "/shop/Sku_prtdetails";
		 	$.ajax({
		 		type:"post",
		 		data:data,
		 		dataType:'json',
		 		url:url,
		 		async:false,
		 		success:function(res){
		 			if(res.code == 200){
		 				$("#goods_price").html(res.data.goods_price);
		 				$("#goods_store").text(res.data.goods_store);
						$("#submitdescde").hide();
						$(".submit").show();
		 			}else{
		 				alert("请先选择商品！");
		 			}
		 		}

		 	})
		 }
	})
//—————————————————————————————————————————————————————————————————————//
/*		 			if(res){
		 				$("#spe_price").text(res.spe_price);
		 				$("#spe_number").text("库存:"+res.spe_num);
		 			}
*/
		// $(document).on("click",".Add_style",function(){
		// 	var _this = $(this);
		// 	_this.addClass("selected").parent().siblings().children().removeClass("selected");
		// 	var attrval_id = _this.attr("attrval_id");
		// 	var attr_id = _this.attr("id");
		// 	if(attrval_id !== "2"){
		// 		return false;
		// 	}
		// 	var add = [];
		// 	var arr = [];
		// 	if(attrval_id == 1){
		// 		add[attrval_id]=attr_id;
		// 		return false;
		// 	}
		// 	if(attrval_id == 2){
		// 		arr[attrval_id]=attr_id;
		// 	}
		// 	var goods_id = $(".sku-name").attr("goods_id");
		// 	var url = "/shop/Sku_prtdetails";
		// 	$.ajax({
		// 		url:url,
		// 		type:'post',
		// 		data:{attrval_id:attrval_id,attr_id:attr_id,goods_id:goods_id},
		// 		async:true,
		// 		success:function(index){
		// 			console.log(index);
		// 		}
		// 	});
		// 	$("#submitdescde").hide();
		// 	$(".submit").show();
		// });
//————————————————————————选择属性————————————————————————————————————————————//
		$("#submitdescde").click(function(){
			alert("请选择属性");
		});
//————————————————————————————————————————————————————————————————————//
		$(document).on("click",".plus",function(){//加
			var _this=$(this).val();
			// console.log(_this);
			var goods_price=parseInt($("#goods_price").text());//价格
		
			var goods_store=parseInt($("#goods_store").text());//库存	
			// alert("价格"+goods_price);
			// alert("库存"+goods_store);
			var goods_num=parseInt($(this).prev().val());//文本框
			//console.log(goods_price);
			if((goods_num+1) > goods_store){
				alert("库存不足..........");return;
			}else{
				goods_num=goods_num+1;
				$(this).prev().val(goods_num);
				goods_store=$("#goods_store").text();
				//Zongjia(_this);
				var goods_price=parseInt($("#goods_price").attr("ids"));
				$("#goods_price").text(goods_price*goods_num);

			}
		})
//————————————————————————————————————————————————————————————//
		$(document).on("click",".mins",function(){//减
			var goods_price=parseInt($("#goods_price").text());//价格
			var goods_store=parseInt($("#goods_store").text());//库存	
			// alert("价格"+goods_price);
			// alert("库存"+goods_store);
			var goods_num=parseInt($(this).prev().prev().val());//文本框
			if((goods_num-1) < 1){
					alert("最少购买一件懂？");return;
				}else{
					goods_num=goods_num-1;
					$(this).prev().prev().val(goods_num);
					var goods_price=parseInt($("#goods_price").attr("ids"));
					$("#goods_price").text(goods_num*goods_price);
			}
		})
//————————————————————————————————————————————————————————————//
		$(document).on("blur",".itxt",function(){//文本框
			var _this=$(this).val();
			var re=/^\d+$/;
			//console.log(_this);
			if(_this==''){
				alert('不可为空');
				$(".itxt").val(1);return false;
			} 
			if(!re.test(_this)){
				alert("必须是纯数字");
				$(".itxt").val(1);return false;
			}
			if(_this<1){
				alert("最少购买一件");
				$(".itxt").val(1);return false;
			}
		})  
//————————————————————————————————————————————————————————————//
		$(document).on("click",".submit",function(){//加入购物车
			//alert("加入购物车");
			var goods_id=$(this).prop("id");//商品ID
			var goods_num=$(".itxt").val();//购买数量
			var goods_price=$("#goods_price").attr("ids");
			var goods_totall=goods_num*goods_price;
		
			$.ajax({
				url:"{{url('/shop/savecar')}}",
				data:{goods_id:goods_id,goods_num:goods_num,goods_totall:goods_totall},
				type:"post",
				success:function(res){
					if(res==1){
						if(confirm("商品已成功加入购物车!，是否进行结算")){
							location.href="/shop/cart";
						}
					}else if(res==2){
					
					  alert('库存不足，或者购物车已买此商品的最大库存量');return;
					
					}else if(res==3){
						alert('库存不足，或者购物车已买此商品的最大库存量');return;
					}
				}
			})
		});
        //收藏
        $(document).on("click","#collect",function(){
              _this = $(this);
			if(_this.text()=="收藏"){
				_this.text("已收藏");
				var is_collect="2";
			}else{
				_this.text("收藏");
				var is_collect="1";
			}
			var goods_id = $(".sku-name").attr("goods_id");
			$.ajax({
                   url:"/shop/collect/"+goods_id,
				   data:{is_collect:is_collect},
				   type:"get",
				   dataType:"json",
				   success:function(res){
					  console.log(res);
				  }
			})
		})
		//非登陆不可以进行收藏
		$(document).on("click","#nocollect",function(){
			if(confirm("是否进行登录?")){
				location.href="/shop/login";
			}
		})
	});


</script>
