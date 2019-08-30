@extends('pest')

@section('content')
    <div class="content-box">
        <div class="question-box">

            @foreach($questions as $question)
                <div class="question-content">
                    <p class="question-sub">{{$question->title}}</p>
                    @foreach($question->answers as $k=>$answer)
                        <div class="option" data-rec="{{$k+1}}"
                             style="background-image: url(/img/{{$imgs[$k]}}.png)">{{$answer->title}}</div>
                    @endforeach
                </div>
            @endforeach

            <div class="clearBox"></div>
            <div class="next-page">下一个</div>
        </div>
        <div class="fruit-img"></div>
    </div>

    <script>
        if ('{{$tree_sign}}' == 1) {
            $('body').css('background', 'url("/img/peach.jpg") no-repeat');
            $('.fruit-img').css({
                top: '230px',
                left: '70px'
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
            if (!isClick) {
                return;
            }
            isClick = false;
            for (var i = 0; i < answer.length; i++) {
                $('.question-content .option:nth-of-type(' + answer[i] + ')').css('background-image', 'url("/img/error.png")');
            }
            $('.question-box').children('.question-content').first().animate({
                'margin-left': "-100%"
            }, 1500, 'swing', function () {
                $(this).remove();
                isClick = true;
                answer = [];
                clickCount = 0;
            });
            index++;
        });


        //框框点击事件
        var clickCount = 0,
            type = 1;
        var answer = [],
            submitArray = [],
            isClick = true;
        ;
        $('.content-box').on('click', '.option', function () {
            var data;
            var currentId = $(this).attr('data-rec');
            var a = 1;
            if (clickCount >= 1) {
                return;
            }
            answer.push(currentId);
            if (type == 1) {
                clickCount++;
            }
            if (currentId == 1) {
                $(this).css('background-image', 'url("/img/selectA.png")');
            } else if (currentId == 2) {
                $(this).css('background-image', 'url("/img/selectB.png")');
            } else if (currentId == 3) {
                $(this).css('background-image', 'url("/img/selectC.png")');
            } else if (currentId == 4) {
                $(this).css('background-image', 'url("/img/selectD.png")');
            }
        });
    </script>

@endsection

