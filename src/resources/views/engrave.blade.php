@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/engrave.css')}}">
@endsection

@section('nav')
<div class="header-right">
    <nav class="lists">
        <ul class="list">
            @if(Auth::check())
            <li class="item"><a href="{{route('log.eng')}}">ホーム</a></li>
            <li class="item"><a href="{{route('log.atten')}}">日付一覧</a></li>
            <li class="item">
                <form action="/logout" class="form" method="post">
                    @csrf
                    <button class="form-button" type="submit">ログアウト</button>
                </form>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endsection

@section('content')
<div class="main">
    @foreach($users as $user)
    <div class="message">
        <h2 class="message-inner">{{$user['name']}}さんお疲れ様です！</h2>
    </div>
    @endforeach
    <form action="/" class="form" method="post">
        @csrf
        <div class="cards">
            <div class="card">
                <form action="{{route('log.start')}}" method="post">
                    @csrf
                    <button class="inner">勤務開始</button>
                    <input type="hidden" name="start_time" value="">
                </form>
            </div>
            <div class="card">
                <form action="{{route('log.end')}}" method="post">
                    @csrf
                    <button class="inner">勤務終了</button>
                    <input type="hidden" name="end_time" value="">
                </form>
            </div>
        </div>
        <div class="cards">
            <div class="card">
                <form action="" method="post">
                    @csrf
                    <button class="inner">休憩開始</button>
                    <input type="hidden" name="break_time" value="">
                </form>
            </div>
            <div class="card">
                <form action="" method="post">
                    @csrf
                    <button class="inner">休憩終了</button>
                    <input type="hidden" name="working" value="">
                </form>
            </div>
        </div>
    </form>
</div>

@endsection