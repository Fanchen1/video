<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>登录</title>

    <link href="/Admin/Login/css/bootstrap.min.css" title="" rel="stylesheet" />
    <link title="orange" href="/Admin/Login/css/login.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="/layui/layui.all.js"></script>
</head>
<body>

<div style="height:1px;"></div>
<div class="login">
    <header>
        <h1>登陆</h1>
    </header>
    <div class="sr">
        <form>
            <div class="name">
                <label>
                    <i class="sublist-icon glyphicon glyphicon-user"></i>
                </label>
                <input type="text"  placeholder="这里输入登录名" class="name_inp" name="name">
            </div>
            <div class="name">
                <label>
                    <i class="sublist-icon glyphicon glyphicon-pencil"></i>
                </label>
                <input type="text"  placeholder="这里输入登录密码" class="name_inp" name="pwd">
            </div>
            <button class="dl" type="button">登陆</button>
        </form>
    </div>
</div>

</body>
</html>
<script>
    $('.dl').click(function(){
        var name = $('input[name=name]').val();
        if(name == ''){
            layer.msg('账号不能为空', { anim: 4});
            return false;
        }

        var pwd = $('input[name=pwd]').val();
        if(pwd == ''){
            layer.msg('密码不能为空', { anim: 2});
            return false;
        }



    })
</script>
