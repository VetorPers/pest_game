@extends('pest')

@section('content')

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
@endsection


