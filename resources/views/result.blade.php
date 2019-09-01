<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <title>三峡</title>
    <script src="{{asset('js/jquery.js')}}"></script>
    <style>
        body {
            background-image: url("/img/graybg.jpg");
        }
    </style>
</head>

<body>

<content>
    <div class="content-box">

        @if($is_pass)
            <div class="over-box">
                <audio id="winer" autoplay>
                    <source src="{{asset('audio/win.wav')}}"/>
                </audio>

                <div class="score" style="background-image: url(/img/win.png)">
                    {{$score}}
                </div>
                <div class="pass">
                    <img src="/img/pass.png" alt="">
                </div>
            </div>
        @else
            <div class="over-box">
                <audio id="losser" autoplay>
                    <source src="{{asset('audio/loss.mp3')}}"/>
                </audio>

                <div class="score" style="background-image: url(/img/loss.png)">
                </div>
                <div class="pass" onclick="Restart()">
                    <img src="/img/restart.png" alt="">
                </div>
            </div>
        @endif
    </div>
</content>
<script>
    function Restart() {
        location.href = '/'
    }
</script>
</body>
</html>
