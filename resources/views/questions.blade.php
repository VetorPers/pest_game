<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>三峡</title>
    <script src="{{asset('js/jquery.js')}}"></script>

    <style>
        .header-box {
            width: 100%;
            height: 22%;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
        }

        .header-box .cloud-group {
            width: 100%;
            height: 100%;
        }

        .header-box .bird {
            position: absolute;
            top: 60%;
            right: 33%;
            width: 4%;
        }

        .header-box .sun {
            position: absolute;
            top: 20%;
            right: 7%;
            width: 5%;
        }

        .cloud-group .cloud {
            float: left;
            position: absolute;
            animation: cloudMove linear infinite normal;
        }

        .cloud-group .cloud-middle {
            top: 12%;
            left: -248px;
            width: 12%;
            animation-duration: 10s;
            animation-delay: 5s;
        }

        .cloud-group .cloud-small {
            top: 64%;
            left: -145px;
            width: 7%;
            animation-duration: 10s;
            animation-delay: 3s;
        }

        .cloud-group .cloud-large {
            top: 30%;
            left: -400px;
            width: 21%;
            animation-duration: 10s;
        }

        @keyframes cloudMove {
            0% {
                left: -400px;
            }
            100% {
                left: 1920px;
            }
        }

        .cloud-small > img {
            width: 100%;
        }

        .cloud-middle > img {
            width: 100%;
        }

        .cloud-large > img {
            width: 100%;
        }

        .question-content-box {
            width: 42%;
            height: 540px;
            /* margin: 12% 25% 0 0; */
            bottom: 18%;
            right: 6%;
            overflow: hidden;
            position: absolute;
        }

        .question-box {
            width: 220%;
            position: relative;
        }

        .question-content-box .next-page {
            width: 6%;
            height: 50px;
            border: 2px solid #ffffff;
            background-color: #00a38d;
            color: #fff;
            line-height: 50px;
            text-align: center;
            font-size: 24px;
            border-radius: 12px;
            cursor: pointer;
            position: fixed;
            bottom: 8%;
            right: 6%;
        }

        .question-content {
            width: 45%;
            height: 540px;
            border: 3px solid #ffffff;
            border-radius: 8px;
            background-color: #007a8d;
            font-size: 24px;
            color: #ffffff;
            padding-left: 3%;
            cursor: pointer;
            box-sizing: border-box;
            float: left;
        }

        .question-box .question-content {
            margin-right: 10%;
        }

        .question-content p {
            margin: 10px 0
        }

        .question-content .option {
            width: 95%;
            height: 105px;
            padding-left: 3%;
            line-height: 107px;
            margin-bottom: 0;
            cursor: pointer;
            background-repeat: no-repeat;
            background-size: 100%;
        }

        .fruit-img {
            width: 148px;
            height: 148px;
            border: 2px solid #ffffff;
            border-radius: 148px;
            position: fixed;

        }

        .clearBox {
            clear: both;
            margin: 0;
            padding: 0;
            height: 0;
        }

        @media screen and (max-width: 1680px) {
            .question-content-box {
                height: 450px;
            }

            .question-content {
                font-size: 18px;
                height: 400px;
            }

            .question-content {
                font-size: 20px;
            }

            .question-content .option {
                height: 90px;
                line-height: 92px;
            }

            .question-content-box .next-page {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 1440px) {
            .question-content-box {
                height: 400px;
            }

            .question-content {
                font-size: 18px;
                height: 400px;
            }

            .question-content .option {
                height: 80px;
                line-height: 82px;
            }

            .question-content-box .next-page {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 1200px) {
            .question-content-box {
                height: 350px;
            }

            .question-content {
                font-size: 18px;
                height: 350px;
            }

            .question-content {
                font-size: 16px;
            }

            .question-content .option {
                height: 60px;
                line-height: 62px;
            }

            .question-content-box .next-page {
                font-size: 16px;
            }
        }

    </style>
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

<div class="question-content-box">
    <div class="question-box">

        @foreach($questions as $question)
            <div class="question-content" data-id="{{$question->id}}" data-type="{{$question->type}}">
                <p class="question-sub">{{$question->title}}</p>
                @foreach($question->answers as $k=>$answer)
                    <div class="option" data-rec="{{$k+1}}" data-right="{{$answer->is_right}}"
                         data-aid="{{$answer->id}}"
                         style="background-image: url(/img/{{$imgs[$k]}}.png)">{{$answer->title}}</div>
                @endforeach
            </div>

            <div class="fruit-img" style="background-image: url({{$question->img}})"></div>
        @endforeach

    </div>

    <div class="clearBox"></div>
    <div class="next-page">下一题</div>
</div>

<script>
    var clickCount = 0,
        index = 1;

    //桃子李子
    if ('{{$tree_sign}}' == 1) {
        $('body').css('background', 'url("/img/peach.jpg") no-repeat');
        $('.fruit-img').css({
            top: '230px',
            left: '376px'
        })
    } else {
        $('body').css('background', 'url("/img/lizi.jpg") no-repeat');
        $('.fruit-img').css({
            top: '600px',
            left: '410px'
        })
    }

    //下一页
    $('.next-page').click(function () {
        var length = '{{$questions->count()}}';

        if (length - 1 == index) {
            $('.next-page').html('保存');
        } else if (index == length) {
            $.post('/pest/storeUserAnswer', {}, function (res) {
                if (res.result) {
                    window.location.href = '/pest/result/' + res.id
                } else {

                }
            })
        }

        $('.question-box').children('.question-content').first().animate({
            opacity: 0
        }, 500, 'swing', function () {
        }).animate({
            'margin-left': "-100%"
        }, 600, 'swing', function () {
            $(this).remove();
            answer = [];
            clickCount = 0;
        });
        index++;
    });

    var questionItem;
    //框框点击事件
    $('.question-content').on('click', '.option', function () {
        var answerItem = [];
        var currentId = $(this).attr('data-rec');
        question_id = $(this).parent.attr('data-id');
        answerItem.push($(this).attr('data-aid'));

        selectOrCancel(currentId, this)
    });

    function selectOrCancel(index, $this) {
        var arr = ['A', 'B', 'C', 'D']
        if ($($this).attr('data-selected') == 1) {
            $($this).css('background-image', 'url("/img/' + arr[index - 1] + '.png")');
            $($this).attr('data-selected', 0);
        } else {
            $($this).css('background-image', 'url("/img/select' + arr[index - 1] + '.png")');
            $($this).attr('data-selected', 1);
        }
    }
</script>

</body>
</html>
