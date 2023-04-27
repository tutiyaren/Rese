@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance.css')}}">
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

    <div class="date">
        {{-- ぺージネーション --}}
    </div>

    <div class="inner">
        <table class="table">
            {{-- タイトル --}}
            <tr class="table-row">
                <th class="table-row__th">名前</th>
                <th class="table-row__th">勤務開始</th>
                <th class="table-row__th">勤務終了</th>
                <th class="table-row__th">休憩時間</th>
                <th class="table-row__th">勤務時間</th>
            </tr>
            {{-- 内容 --}}
            <tr class="table-row">
                <td class="table-row__td">
                    <form action="" method="" class="table-row__form">
                        @csrf
                        <div class="table-row__item">
                            <p class="table-row__item-1"></p>
                        </div>
                        <div class="table-row__item">
                            <p class="table-row__item-2"></p>
                        </div>
                        <div class="table-row__item">
                            <p class="table-row__item-3"></p>
                        </div>
                        <div class="table-row__item">
                            <p class="table-row__item-4"></p>
                        </div>
                        <div class="table-row__item">
                            <p class="table-row__item-5"></p>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <div class="page">
        {{-- ぺージネーション --}}
    </div>

</div>

@endsection