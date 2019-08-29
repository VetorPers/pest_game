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
        @if($is_pass)
            <div class="over-box" style="background-image: url(/img/win.png)">{{$score}}</div>
        @else
            <div class="over-box" style="background-image: url(/img/lossgame.png)"></div>
        @endif
    </div>
</content>

</body>
<script>

</script>

</html>
