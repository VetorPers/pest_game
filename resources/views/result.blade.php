@extends('pest')

@section('content')

    @if($is_pass)
        <div class="over-box" style="background-image: url(/img/win.png)">{{$score}}</div>
    @else
        <div class="over-box" style="background-image: url(/img/lossgame.png)"></div>
    @endif

@endsection

