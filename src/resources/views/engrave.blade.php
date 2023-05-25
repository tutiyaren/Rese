@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/engrave.css')}}">
@endsection

@section('nav')
<div class="header-right">
    <nav class="lists">
        <ul class="list">
            @if(Auth::check())
            <li class="item @if(Route::currentRouteName() === 'log.eng') active @endif"><a href="{{route('log.eng')}}">ホーム</a></li>
            <li class="item @if(Route::currentRouteName() === 'log.users') active @endif"><a href="{{route('log.users')}}">従業員一覧</a></li>
            <li class="item @if(Route::currentRouteName() === 'log.diligence') active @endif"><a href="{{route('log.diligence')}}">勤怠一覧</a></li>
            <li class="item @if(Route::currentRouteName() === 'log.atten') active @endif"><a href="{{route('log.atten')}}">日付一覧</a></li>
            <li class="item">
                <form action="/logout" class="form" method="post">
                    @csrf
                    <button class="form-button" type="submit">ログアウト</button>
                </form>
            </li>
            {{--ハンバーガーメニュー--}}
            @endif
        </ul>
    </nav>
</div>
@endsection

@section('content')
<div class="main">
    @if(Auth::check())
    <div class="message">
        <h2 class="message-inner">{{Auth::user()->name}}さんお疲れ様です！</h2>
    </div>
    @endif

    <div class="cards">
        <div class="card">
            <form action="{{route('log.start')}}" method="post">
                @csrf
                @if(!$working)
                <button class="inner">勤務開始</button>
                <input type="hidden" name="start_time" value="{{Carbon\Carbon::now()->format('Y-m-d H:i:s')}}">
                @else
                <button class="inner" disabled>勤務開始</button>
                <input type="hidden" name="start_time" value="{{Carbon\Carbon::now()->format('Y-m-d H:i:s')}}">
                @endif
            </form>
        </div>
        <div class="card">
            @if(!$working && !$number2)
            <button class="inner" disabled>勤務終了</button>
            @else
            <form id="work-end-form" action="{{route('log.end')}}" method="post">
                @csrf
                <button class="inner">勤務終了</button>
                <input type="hidden" name="end_time" value="{{Carbon\Carbon::now()->format('Y-m-d H:i:s')}}">
            </form>
            @endif
        </div>
    </div>
    <div class="cards">
        <div class="card">
            @if($working && !$number2)
            <form action="{{route('log.start_rest')}}" method="post">
                @csrf
                <button class="inner">休憩開始</button>
                <input type="hidden" name="start_rest" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
                <input type="hidden" name="slack_id" value="{{ $existing_record ? $existing_record->id : '' }}">
            </form>
            @else
            <button class="inner" disabled>休憩開始</button>
            @endif
        </div>
        <div class="card">
            @if($working && !$number3)
            <form action="{{route('log.end_rest')}}" method="post">
                @csrf
                <button class="inner">休憩終了</button>
                <input type="hidden" name="end_rest" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
                <input type="hidden" name="slack_id" value="{{ $existing_record ? $existing_record->id : '' }}">
            </form>
            @else
            <button class="inner" disabled>休憩終了</button>
            @endif
        </div>
    </div>
</div>

@endsection