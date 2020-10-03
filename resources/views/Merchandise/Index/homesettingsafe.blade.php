<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
     <link rel="icon" href="/assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/index/static/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/index/static/css/pages-seckillOrder.css" />
</head>

<body>
@include('layouts.index.top')

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
<script type="text/javascript" src="/index/static/js/widget/nav.js"></script>
<!-- <script type="text/javascript" src="/index/static/plugins/jquery.validate/jquery.validate.js"></script> -->
<script>
        $(function(){
            //jquery.validate
            $("#jsForm").validate({
            submitHandler: function() {
                //验证通过后 的js代码写在这里
            }
        })		
        })
    
        //下面是一些常用的验证规则扩展

        /*-------------验证插件配置 懒人建站http://www.51xuediannao.com/-------------*/

        //配置错误提示的节点，默认为label，这里配置成 span （errorElement:'span'）
        $.validator.setDefaults({
        errorElement:'span'
        });

        //配置通用的默认提示语
        $.extend($.validator.messages, {
        required: '必填',
        equalTo: "请再次输入相同的值"
        });

        /*-------------扩展验证规则使用-------------*/
        //邮箱 
        jQuery.validator.addMethod("mail", function (value, element) {
        var mail = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$/;
        return this.optional(element) || (mail.test(value));
        }, "邮箱格式不对");

        //电话验证规则
        jQuery.validator.addMethod("phone", function (value, element) {
        var phone = /^0\d{2,3}-\d{7,8}$/;
        return this.optional(element) || (phone.test(value));
        }, "电话格式如：0371-68787027");

        //区号验证规则  
        jQuery.validator.addMethod("ac", function (value, element) {
        var ac = /^0\d{2,3}$/;
        return this.optional(element) || (ac.test(value));
        }, "区号如：010或0371");

        //无区号电话验证规则  
        jQuery.validator.addMethod("noactel", function (value, element) {
        var noactel = /^\d{7,8}$/;
        return this.optional(element) || (noactel.test(value));
        }, "电话格式如：68787027");

        //手机验证规则  
        jQuery.validator.addMethod("mobile", function (value, element) {
        var mobile = /^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mobile.test(value));
        }, "手机格式不对");

        //邮箱或手机验证规则  
        jQuery.validator.addMethod("mm", function (value, element) {
        var mm = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mm.test(value));
        }, "格式不对");

        //电话或手机验证规则  
        jQuery.validator.addMethod("tm", function (value, element) {
        var tm=/(^1[3|4|5|7|8]\d{9}$)|(^\d{3,4}-\d{7,8}$)|(^\d{7,8}$)|(^\d{3,4}-\d{7,8}-\d{1,4}$)|(^\d{7,8}-\d{1,4}$)/;
        return this.optional(element) || (tm.test(value));
        }, "格式不对");

        //年龄
        jQuery.validator.addMethod("age", function(value, element) {   
        var age = /^(?:[1-9][0-9]?|1[01][0-9]|120)$/;
        return this.optional(element) || (age.test(value));
        }, "不能超过120岁"); 
        ///// 20-60   /^([2-5]\d)|60$/

        //传真
        jQuery.validator.addMethod("fax",function(value,element){
        var fax = /^(\d{3,4})?[-]?\d{7,8}$/;
        return this.optional(element) || (fax.test(value));
        },"传真格式如：0371-68787027");

        //验证当前值和目标val的值相等 相等返回为 false
        jQuery.validator.addMethod("equalTo2",function(value, element){
        var returnVal = true;
        var id = $(element).attr("data-rule-equalto2");
        var targetVal = $(id).val();
        if(value === targetVal){
            returnVal = false;
        }
        return returnVal;
        },"不能和原始密码相同");

        //大于指定数
        jQuery.validator.addMethod("gt",function(value, element){
        var returnVal = false;
        var gt = $(element).data("gt");
        if(value > gt && value != ""){
            returnVal = true;
        }
        return returnVal;
        },"不能小于0 或空");

        //汉字
        jQuery.validator.addMethod("chinese", function (value, element) {
        var chinese = /^[\u4E00-\u9FFF]+$/;
        return this.optional(element) || (chinese.test(value));
        }, "格式不对");

        //指定数字的整数倍
        jQuery.validator.addMethod("times", function (value, element) {
        var returnVal = true;
        var base=$(element).attr('data-rule-times');
        if(value%base!=0){
            returnVal=false;
        }
        return returnVal;
        }, "必须是发布赏金的整数倍");

        //身份证
        jQuery.validator.addMethod("idCard", function (value, element) {
        var isIDCard1=/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/;//(15位)
        var isIDCard2=/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;//(18位)

        return this.optional(element) || (isIDCard1.test(value)) || (isIDCard2.test(value));
        }, "格式不对");
    </script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
               
						@include('layouts.index.left')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">密码设置</a></li>
                            <li><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">

                    <!--####################表单提交用户信息################  -->
                    <div id="one" class="tab-pane active">
                        <form class="sui-form form-horizontal sui-validate" id="jsForm">
                            <div class="control-group">
                            <label for="inputusername" class="control-label">用户名：</label>
                                <div class="controls">
                                    <input id="pwdid" class="fn-tinput" data-rule-remote="http://www.baidu.com" type="text" 
                                            name="uset_name" placeholder="输入昵称"required data-msg-required="请输入昵称" 
                                            minlength="6" data-msg-minlength="至少输入6个字符"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="inputPassword" class="control-label">密码：</label>
                                <div class="controls">
                                    <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required
                                     id="password" data-rule-remote="php.php">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="inputRepassword" class="control-label">重复密码：</label>
                                <div class="controls">
                                    <input class="fn-tinput" type="password" name="user_password" value="" placeholder="确认新密码" 
                                    required equalTo="#password">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <button type="submit" class="sui-btn btn-primary submit">提交按钮</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--####################表单提交用户信息################  -->

                            <div id="two" class="tab-pane">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">2</span><span>第二步 绑定新手机号</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">3</span><span>第三步 完成</span></label>
                                        </div>
                                    </div>
                                </div>

                                <!--表单-->
                                <form class="sui-form form-horizontal sui-validate" data-toggle='validate' id="bind-form">

                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">验证方式：</label>
                                        <div class="controls fixed" attr_id="">手机验证（138****9856）</div>                            
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">短信验证码：</label>
                                        <div class="controls">
                                            <input name="msgcode" type="text" id="msgcode">
                                        </div>
                                        <div class="controls">
                                            <button class="sui-btn btn-info">发送</button>
                                            <a href="javascript:;" class="sui-btn btn-infoa hide"></a>
                                        </div>
                                    </div>
                                    <div class="control-group next-btn">
                                        <a class="sui-btn btn-primary next_step" href="javascript:;">下一步</a>
                                    </div>
                                </form>

                            </div>
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
</html>
<script>
    $(function(){
        //提交按钮
        $(".submit").click(function(){
            var user_name = $("[name='uset_name']").val();
            var password = $("[name='password']").val();
            var user_password = $("[name='user_password']").val();
            if(user_name == ""){
                alert("请填写正确的用户名");
                return false;
            }
            if(password == ""){
                alert("请填写正确的密码");
                return false;
            }
            if(user_password == ""){
                alert("请填写正确的确认密码");
                return false;
            }
            if(parseInt(password) !== parseInt(user_password)){
                alert("请填写正确的密码和确认密码");
                return false;
            }
            var url = "/shop/homesettingsafe";
            $.ajax({
                url:url,
                type:"post",
                data:{user_name:user_name,password:password},
                dataType:'json',
                async:true,
                success:function(index){
                    if(index.error == 0){
                        alert(index.msg);
                        var user_del = index.data.user_tel;
                        $(".fixed").attr("attr_id",user_del);
                        $(".fixed").html(user_del);
                    }else{
                        alert(index.msg);
                    }
                }
            });
            return false;
        });
        //绑定手机号
        $(".btn-info").click(function(){
            var user_tel = $(".fixed").attr("attr_id");
            if(user_tel == ""){
                alert("请提交用户名和密码！");
                return false;
            }
            //验证码倒计时
            $(".btn-infoa").show();
            $(".btn-infoa").html("60");
            $(".btn-info").hide();
            var intval = setInterval( function(){
                var s = $(".btn-infoa").html();
                if(s <= 1){
                    clearInterval(intval);
                    $(".btn-infoa").hide();
                    $(".btn-info").show();
                }else{
                    s = s-1;
                    $(".btn-infoa").html(s);
                }
            } , 1000);
            var url = "/shop/sends/verification/code";
            $.ajax({
                url:url,
                dataType:"json",
                type:"post",
                data:{user_tel:user_tel},
                async:true,
                success:function(index){
                    if(index.error == 0){
                        alert(index.msg);
                    }else{
                        alert(index.msg);
                    }
                }
            });
            return false;
        });
        //验证码验证
        $("#msgcode").blur(function(){
            var code_name = $(this).val();
            console.log(code_name);
        });
        //下一步
        $(".next_step").click(function(){
            var code = $("[name='msgcode']").val();
            if(code == ""){
                alert("请填写验证码！");
                return false;
            }
            var user_tel = $(".fixed").attr("attr_id");
            if(user_tel == ""){
                alert("请提交用户名和密码！");
                return false;
            }
            var user_name = $("[name='uset_name']").val();
            var password = $("[name='password']").val();
            var user_password = $("[name='user_password']").val();
            if(user_name == ""){
                alert("请填写正确的用户名");
                return false;
            }
            if(password == ""){
                alert("请填写正确的密码");
                return false;
            }
            if(user_password == ""){
                alert("请填写正确的确认密码");
                return false;
            }
            if(parseInt(password) !== parseInt(user_password)){
                alert("请填写正确的密码和确认密码");
                return false;
            }
            var url = "/shop/sends/verification/code";
            $.ajax({
                url:url,
                dataType:"json",
                type:"get",
                data:{user_tel:user_tel,code:code,user_name:user_name,password:password},
                async:true,
                success:function(index){
                    if(index.error == 0){
                        alert(index.msg);
                        location.href="/shop/homesettingsafe";
                    }else{
                        alert(index.msg);
                    }
                }
            });
            return false;
        });
    });
</script>