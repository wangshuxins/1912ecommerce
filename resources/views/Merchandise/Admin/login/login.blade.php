<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/admin/static/login/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/static/login/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/admin/static/login/css/animate.css" rel="stylesheet">
    <link href="/admin/static/login/css/style.css" rel="stylesheet">
    <link href="/admin/static/login/css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-12">
                <form method="post">
                    <h4 class="no-margins">Hi~❤</h4>
                    <p class="m-t-md">登录后台</p>
                    <input type="text" class="form-control uname" name="user_name" placeholder="用户名" />
                    <input type="password" class="form-control pword m-b" name="user_pwd" placeholder="密码" />
                    <label>
                           <input type="checkbox" value="1" name="isremember">七天免登录
                    </label>
                    <button type="button" class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">

            </div>
        </div>
    </div>
</body>

</html>
<script src="/admin/static/login/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.btn-block',function(){
             var user_name = $('[name="user_name"]').val();
             var user_pwd = $('[name="user_pwd"]').val();
             var isremember = $('[name="isremember"]:checked').val();
                    $.ajax({
                        url:'/admin/logindo',
                        data:{user_name:user_name,user_pwd:user_pwd,isremember:isremember},
                        dataType:'json',
                        type:"post",
                            success:function(res){
                                    if(res.error_no==0)
                                    {
                                        alert(res.error_msg);
                                        location.href="/admin/shouye";
                                    }else if(res.error_no==1){
                                        alert(res.error_msg);
                                    }else if(res.error_no==2){
                                        alert(res.error_msg);
                                    }
                            }
                    })
                })
</script>