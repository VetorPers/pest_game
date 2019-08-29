@extends('pest')

@section('content')

    <div class="login-group">
        <div class="btn btn-play"></div>
    </div>

    <script>
        $('.btn-play').click(function () {
            window.location.href = '/pest/questions'
        })
    </script>
@endsection


