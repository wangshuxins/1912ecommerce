<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>


    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-register.css" />
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>注册新用户<span class="go">我有账号，去<a href="{{url('/shop/login')}}" target="_blank">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal">
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" placeholder="请输入你的用户名" id="user_name" class="input-xfat input-xlarge">
						</div>
						<span id="span_name"></span>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" placeholder="设置登录密码" id="user_pwd" class="input-xfat input-xlarge">
						</div>
						<span id="span_pwd"></span>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" placeholder="再次确认密码" id="user_pwds" class="input-xfat input-xlarge">
						</div>
						<span id="span_pwds"></span>
					</div>
					
					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" placeholder="请输入你的手机号" id="user_tel" class="input-xfat input-xlarge">
						</div>
						<span id="span_tel"></span>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" placeholder="短信验证码" id="code"   class="input-xfat input-xlarge"> 
							 <button type="button" style="width:50px;height:38px;" class="taoqian">获取</button>
							<br>
							 <span class="span_yzm"></span>
						</div>
					</div>
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<button type="button" style="height:50px;width:70px;background color:red;" id="success" >完成注册</button>
<!-- 							<a class="sui-btn btn-block btn-xlarge btn-danger" id="success" target="_blank">完成注册</a>
 -->						</div>
					</div>
				</form>
				<div class="clearfix"></div>
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
<script type="text/javascript" src="/index/static/js/pages/register.js"></script>
</body>

</html>
<!-- <embed width="600" height="60" border="1" autostart="false" loop="true" src="/yinyue/huanghuai.mp3"autoplay></embed> -->
<!--     <embed width="300" height="60" border="1" autostart="false" loop="true" src="./yinyue/yeshiheku.mp3"autoplay></embed>
 --> <!--    <marquee behavior="" direction=""><font color='red'>
            <h1>也许夜最适合哭赵鑫宝</h1>
        </font></marquee> -->
<script>
	$(document).ready(function(){
		//用户名验证
		$(document).on("blur",'#user_name',function(){
			var zhi=$(this).val();
			if(zhi==""){
				$("#span_name").html("<font color='red'>不可为空</font>");return false;
			}
			$.ajax({
				url:"{{url('shop/register')}}",
				data:{zhi:zhi},
				type:"post",
				success:function(res){
					if(res==2){
						$("#span_name").html("<font color='blue'>√</font>");return false;
					}else{
						$("#span_name").html("<font color='red'>用户名已存在,请您另换一个用户名</font>");
						return false;
					}
				}

				})



			});
		//用户名验证
		//密码
		$(document).on("blur","#user_pwd",function(){
			var mima=$(this).val();
				if(mima==""){		
				$("#span_pwd").html("<font color='red'>密码不可为空</font>");
				return false;
			}else	if(!(/^\w{8,16}$/).test(mima)){
				$("#span_pwd").html("<font color='red'>密码必须在8~16位之间</font>");
				return false;
			}else{
				$("#span_pwd").html("<font color='blue'>√</font>");
			}



			});
		//密码
		//确认密码
		$(document).on("blur","#user_pwds",function(){
			var pwd=$("#user_pwd").val();//密码
			var pwds=$(this).val();//确认密码
			if(pwd==""){
			$("#span_pwds").html("<font color='red'>请先输入密码</font>");
				return false;				
			}
			if(pwds==""){
				$("#span_pwds").html("<font color='red'>确认密码不可为空且与密码一致</font>");
				return false;
			}else if(pwd!=pwds){
				$("#span_pwds").html("<font color='red'>确认密码与密码不一致！</font>");
				return false;
			}else{
				$("#span_pwds").html("<font color='blue'>√</font>");
				return false;
			}
		});
		//手机号
		$(document).on("blur","#user_tel",function(){
			var tel=$(this).val();//手机号
			if(tel==""){
					$("#span_tel").html("<font color='red'>手机号不可为空</font>");
      			    return false; 
			}


			if(!(/^1[3456789]\d{9}$/.test(tel))){ 
         			$("#span_tel").html("<font color='red'>手机号码格式有误，请重填</font>");
        			return false; 
   				}

   				$.ajax({
   						url:"{{url('/shop/shoji')}}",
   						data:{tel:tel},
   						type:"post",
   						success:function(res){
   							if(res==1){
   		  					$("#span_tel").html("<font color='red'>该手机号已注册过了...</font>");	
   		  					return false;	
   							}else{
								$("#span_tel").html("<font color='blue'>√</font>");
   							}
   						}
   				});
		
		
		});

		$(document).on("click",".taoqian",function(){
			var tel=$("#user_tel").val();
			var span_tel=$("#span_tel").text();
			if(span_tel!=="√"){
					$(".span_yzm").html("<font color='blue'>请先使用正确格式的手机号</font>");
				alert("请先使用正确格式的手机号");
				return false;
			}

			$.ajax({
					url:"{{url('/shop/registers/taoqiande')}}",
					data:{tel:tel},
					type:"post",
					success:function(res){
						console.log(res);
						alert(res);
					}

			})
			//一个比较简单的定时器

			$(this).text("30s");
			$(".span_yzm").html("<h4><font color='green'>验证码获取中.....请耐心等待</font></h4>");
				times=setInterval(gotimes,1000);
				//定时器   就两个函数简单
				function gotimes(){
					//获取按钮传来的秒数
					var s=$(".taoqian").text(); 
					//parseInt 强行将变量 转化为int类型
					 s=parseInt(s);
					 //倒计时
					 if(s<=0){
					 	//判断当前的秒数是否是小图或等于零的；
					 	//清除倒计时
					 	clearInterval(times);
					 	$(".taoqian").text("获取");
					 	//将a标签的按钮改为不可点击
					 	$(".span_yzm").html("");
					 	$(".taoqian").css("pointer-events","auto");
					 }else{
					 		//时间减一
					 	s=s-1;
					 	//改为当前秒数
					 	$(".taoqian").text(s+"s");
					 	//变为不可点击	
					 	$(".taoqian").css("pointer-events","none");
					 }	}
		});

		$(document).on("blur","#code",function(){
			var code =$(this).val();
					if(code==""){
							$(".span_yzm").html("<font color='blue'>√</font>");
							return false;
					}
					$(".span_yzm").html("<font color='blue'>√</font>");

			});


		$(document).on("click","#success",function(){
			//_____span标签————————————————
			var  span_name=$("#span_name").text();
			var  span_pwd=$("#span_pwd").text();
			var  span_pwds=$("#span_pwds").text();
			var  span_tel=$("#span_tel").text();
			var  span_yzm=$(".span_yzm").text();
			//_____code————————————————
			// code
				// var  tel=$("#code").attr("tel");
				// var  code=$("#code").attr("ids");
			//——————————— input ————
				var  user_tel=$("#user_tel").val();
				var  user_code=$("#code").val();
				var  name=$("#user_name").val();
				var  pwd=$("#user_pwd").val();
			//—————————————————————————为空—————————————————————————————————————
			if(span_name=="" || span_pwd=="" || span_pwds=="" || span_tel=="" || span_yzm==""){
				if(span_name==""){
					$("#span_name").html("<font color='red'>请输入用户名</font>");
				}
				if(span_pwd==""){
					$("#span_pwd").html("<font color='red'>请输入密码</font>");		
				}
				if(span_pwds==""){
						$("#span_pwds").html("<font color='red'>请输入确认密码</font>");
				}
				if(span_tel==""){
						$("#span_tel").html("<font color='red'>请输入手机号</font>");
				}			
				if(span_yzm==""){
						$(".span_yzm").html("<font color='red'>请输入验证码</font>");	
				}
				return false;
			}

			//——————————————————————————————————验证——————————————————————————————————
			if(span_name!=="√"||span_pwd!=="√"||span_pwds!=="√"||span_tel!=="√"||span_yzm!=="√"){
				if(span_name!=="√"){
					$("#span_name").html("<font color='red'>不正确.</font>");
				}
				if(span_pwd!=="√"){
					$("#span_pwd").html("<font color='red'>不正确.</font>");	
				}
				if(span_pwds!=="√"){
						$("#span_pwds").html("<font color='red'>不正确.</font>");
				}
				if(span_tel!=="√"){
						$("#span_tel").html("<font color='red'>不正确.</font>");
				}			
				if(span_yzm!=="√"){
						$(".span_yzm").html("<font color='red'>不正确.</font>");
				}
				return false;	
			}	
				$.ajax({
					url:"{{url('/shop/zhuce')}}",
					data:{user_tel:user_tel,user_code:user_code,name:name,pwd:pwd},
					type:"post",
					success:function(res){
						if(res==2){
							$(".span_yzm").html("<font color='red'>该手机号与验证码不匹配.</font>");
									return false;
						}else if(res==1){
						confirm('注册成功了,即将跳转登录');
							location.href="/shop/login";

						}

					}
				
				})

			





		});

	});



</script>