<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <title>Document</title>
    <script src="{{asset('js/jquery.js')}}"></script>
</head>

<body>
<header>
    <div class="header-box">
        <div class="cloud-group">
            <div class="cloud cloud-middle">
                <img src="{{asset('img/cloud.png')}}" alt="">
            </div>
            <div class="cloud cloud-small">
                <img src="{{asset('img/cloud.png')}}" alt="">
            </div>
            <div class="cloud cloud-large">
                <img src="{{asset('img/cloud.png')}}" alt="">
            </div>
        </div>
        <div class="bird">
            <img src="{{asset('img/bird.png')}}" alt="">
        </div>
        <div class="sun">
            <img src="{{asset('img/sun.png')}}" alt="">
        </div>
    </div>
</header>
<content>
    <div class="content-box">
        <div class="login-group">
            <div class="choice-status">
                <div class="btn btn-manage">
                    <div>管理员登录</div>
                </div>
                <div class="btn btn-student">
                    <div>学号登录</div>
                </div>
                <div class="btn btn-others">
                    <div>游客登录</div>
                </div>
            </div>
            <div class="user-login">
                <input type="button" class="btn btn-account" value="用户名"/>
                <input type="button" class="btn btn-key" value="密码"/>
                <input type="button" class="btn btn-login" value="登录"/>
            </div>
        </div>
    </div>
</content>

</body>
<script>
    $('.btn.btn-manage').click(function () {
        window.location.href = '/admin/charts';
    });
    $('.btn.btn-student').click(function () {
        $(this).parent().css('display', 'none');
        $('.btn.btn-key').css('display', 'none');
        $('.btn.btn-account').val('输入学号');
        accountValue = '输入学号';
        $('.btn.btn-account').css('text-decoration', 'underline');
        $('.user-login').css('display', 'block');
        loginType = 2;
    });
    $('.btn.btn-others').click(function () {
        loginType = 1;
        $('.btn-login').click()
    });

    $('.btn-login').click(function () {
        var data = {
            type: loginType,
        };
        if (loginType == 2) {
            var account = $('.btn-account').val();
            data.number = account;
        }
        $.ajax({
            url: '/login',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (res) {
                if (res.result) {
                    window.location.href = '/pest/questions'
                } else {
                    alert(res.msg)
                }
            }
        });
    });
</script>

</html>
