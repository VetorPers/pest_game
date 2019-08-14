<div class="box">

    <div class="box-header with-border">
        <div class="col-md-3">
            <label class="col-sm-5 control-label text-center">总答题次数: </label>
            <label class="">{{ $total }}</label>
        </div>
        <div class="col-md-3">
            <label class="col-sm-5 control-label text-center">今日答题次数: </label>
            <label class="">{{ $today }}</label>
        </div>
    </div>

    <div class="box-body">
        <div class="col-md-8">
            <div style="position: relative; height:70vh; width:50vw">
                <canvas id="myChart" height="400" width="400"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-12">
                <div class="col-md-8">
                    <select class="grades-select js-states form-control" name="state">
                        <option></option>
                        <option value="0">全部</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 80%">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">Tips:</h4>
                        <div class="small">
                            <ul>
                                <li><p>左侧环形图展示了所有人的答题情况。</p></li>
                                <li><p>选择班级可查看对应班级分数分布图。</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function () {
        $('.grades-select').select2({
            placeholder: "选择班级",
            allowClear: true
        });

        var ctx = $('#myChart');
        var data = {
            datasets: [{
                data: JSON.parse('{{ $all }}'),
                backgroundColor: [
                    '#ff6384',
                    '#ff9f40',
                    '#ffcd56',
                    '#4bc0c0'
                ]
            }],

            labels: [
                '0~60',
                '60~70',
                '70~80',
                '>=80'
            ]
        };

        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: '成绩分布(人)'
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });

        $('.grades-select').change(function () {
            var url = location.href;
            url = url.replace(/\?[\s\S]*/, '');
            location.href = url + "?grade_id=" + $(this).val();
        })
    });
</script>
