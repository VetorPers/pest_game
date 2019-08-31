window.onload = function() {
    var btnAccount = document.getElementsByClassName('btn-account')[0],
        btnKey = document.getElementsByClassName('btn-key')[0],
        accountValue = btnAccount.value,
        keyValue = btnKey.value,
        clickCount = 0,
        loginType = 0,
        userData, questionArray, index = 0, isClick = true, submitArray = [];


    btnAccount.addEventListener('click', function() {
        this.type = 'text';
        this.value = '';
    });
    btnKey.addEventListener('click', function() {
        this.type = 'text';
        this.value = '';
    });
    btnAccount.addEventListener('blur', function() {
        if (this.value == '') {
            this.value = accountValue;
            this.type = 'button';
        }
    });
    btnKey.addEventListener('blur', function() {
        if (this.value == '') {
            this.value = keyValue;
            this.type = 'button';
        }
    });
    //登录
    $('.btn-login').click(function() {
        var data = {
            type: loginType,
        };
        if (loginType == 2){
            var account = $('.btn-account').val();
            data.number = account;
        }
        $.ajax({
            url: 'http://118.24.70.62:8080/pest/login',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(res) {
                console.log(res);
                if (res.user_id == null){
                    alert('学号有误');
                    return;
                }
                userData = res;
                var playBtn = '<div class="btn btn-play"></div>';
                $('.login-group').html(playBtn);
            }
        });
    });

    function createFirstQuestion(data) {
        var question =
            '<div class="question-content first-question">' +
            '<p class="question-type">' + data.desc + '</p>' +
            '<p class="question-sub">' + index+'、'+data.title + '</p>' +
            '<div class="option" data-rec="0" style="background-image: url(img/A.png)" >' + data.answers[0].title + '</div>' +
            '<div class="option" data-rec="1" style="background-image: url(img/B.png)">' + data.answers[1].title + '</div>' +
            '<div class="option" data-rec="2" style="background-image: url(img/C.png)">' + data.answers[2].title + '</div>' +
            '<div class="option" data-rec="3" style="background-image: url(img/D.png)">' + data.answers[3].title + '</div>' +
            '</div>';
        return question;
    }

    function createNextQustion(data) {
        var question =
            '<div class="question-content next-question">' +
            '<p class="question-type">' + data.desc + '</p>' +
            '<p class="question-sub">' + (index+1)+'、'+data.title + '</p>' +
            '<div class="option" data-rec="0" style="background-image: url(img/A.png)">' + data.answers[0].title + '</div>' +
            '<div class="option" data-rec="1" style="background-image: url(img/B.png)">' + data.answers[1].title + '</div>' +
            '<div class="option" data-rec="2" style="background-image: url(img/C.png)">' + data.answers[2].title + '</div>' +
            '<div class="option" data-rec="3" style="background-image: url(img/D.png)">' + data.answers[3].title + '</div>' +
            '</div>';
        return question;
    }
    //开始
    $('body').on('click', '.btn-play', function() {
        var data;
        $.ajax({
            url: 'http://118.24.70.62:8080/pest/questions',
            type: 'get',
            data: {user_id: userData.user_id, tree_sign: userData.tree_sign},
            success: function(res) {
                console.log(res);
                questionArray = res.data;
                index++;
                data = res.data[0];
                $('body').css('background', 'url("img/peach.jpg") no-repeat');
                var firstQuestion = createFirstQuestion(data);
                var qustionBox = '<div class="question-box">' +
                    '<div class = "next-page btn">下一页</div>' +
                    '</div > ';
                $('.content-box').html(qustionBox);
                $('.question-box').append(firstQuestion);
                var fruitImage = '<div class="fruit-img"></div>';
                $('body').append(fruitImage);
                $('.fruit-img').css('backgroud', 'url("' + data.img + '")');
            }
        });
    });


    var answer=[];
    $('.content-box').on('click', '.option', function() {
        var data;
        var currentId = $(this).attr('data-rec');
        var a = 1;
        if (clickCount >= 1) {
            return;
        }
        answer.push((currentId - 0) + 1);
        if(questionArray[index - 1].type == 1){
            clickCount++;
            data={
                question_id:questionArray[index - 1].id,
                answer_ids:answer
            };
            submitArray.push(data);
            answer = [];
        }
        if (questionArray[index - 1].answers[currentId].is_right == 1) {
            $(this).css('background-image', 'url("img/right.png")');
        } else {
            $(this).css('background-image', 'url("img/error.png")');
            if (questionArray[index - 1].type == 2){
                clickCount++;
                data={
                    question_id:questionArray[index - 1].id,
                    answer_ids:answer
                };
                submitArray.push(data);
                answer = [];
            }
        }
    });



    $('.content-box').on('click', '.next-page', function() {
        if (!isClick){
            return;
        }
        isClick = false;
        clickCount = 0;
        if (index == questionArray.length - 1){
            $('.next-page').html('保存');
        }
        if (index == questionArray.length) {
            $.ajax({
                url: 'http://118.24.70.62:8080/pest/storeUserAnswer',
                type: 'post',
                data: {user_id: userData.user_id, data:submitArray},
                // data:{user_id:1, data:[{question_id:1, answer_ids:[1]}]},
                success: function(res) {
                    console.log(res);
                    var overBox;
                    $('body').css('background', 'url("img/graybg.jpg") no-repeat');
                    if (res.is_pass){
                        overBox = '<div class="over-box" style="background-image: url(img/win.png)">100</div>';
                    }else{
                        overBox = '<div class="over-box" style="background-image: url(img/lossgame.png)"></div>';
                    }

                    $('body').html(overBox);
                }
            })
            return;
        };
        var data = questionArray[index];
        var nextQuestion = createNextQustion(data);
        $('.question-box').append(nextQuestion);
        $('.first-question').animate({ left: "-910px", opacity: 0 }, 500, 'swing', function() {
            $(this).remove();
        });
        $('.next-question').animate({ left: "0px", opacity: 1 }, 1000, 'swing', function() {
            $(this).attr('class', 'question-content first-question');
            isClick = true;
        });
        index++;
    });

    $('.btn.btn-manage').click(function() {
        // $(this).parent().css('display', 'none');
        // $('.user-login').css('display', 'block');
        loginType = 0;
        window.location.href = 'http://118.24.70.62:8080/admin/charts';
    });
    $('.btn.btn-student').click(function() {
        $(this).parent().css('display', 'none');
        $('.btn.btn-key').css('display', 'none');
        $('.btn.btn-account').val('输入学号');
        accountValue = '输入学号';
        $('.btn.btn-account').css('text-decoration', 'underline');
        $('.user-login').css('display', 'block');
        loginType = 2;
    });
    $('.btn.btn-others').click(function() {
        loginType = 1;
        $('.btn-login').click()
    });
};