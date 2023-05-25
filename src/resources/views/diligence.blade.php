@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/diligence.css')}}">
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
            @endif
        </ul>
    </nav>
</div>

@endsection

@section('content')
<div class="main">

    <div class="date">
        <div class="date_page">

            {{-- 前の名前へのリンク --}}
            @if ($previousUser)
            <a href="{{ route('log.diligence', ['user_id' => $previousUser->user_id]) }}" class="move prev">&lt;</a>
            @else
            <a href="{{ route('log.diligence', ['user_id' => $lastUser->id]) }}" class="move prev">&lt;</a>
            @endif

            {{-- 名前の表示 --}}
            @if ($currentUser)
            <span class="date_page__name">{{ $currentUser->user_name }}</span>
            @else
            <span class="date_page__name">{{ $user->name }}</span>
            @endif

            {{-- 次の名前へのリンク --}}
            @if ($nextUser)
            <a href="{{ route('log.diligence', ['user_id' => $nextUser->user_id]) }}" class="move next">&gt;</a>
            @else
            <a href="{{ route('log.diligence', ['user_id' => $firstUser->id]) }}" class="move next">&gt;</a>
            @endif


        </div>

        <div class="inner">
            <table class="table">
                {{-- タイトル --}}
                <tr class="table-row">
                    <th class="table-row__th">日付</th>
                    <th class="table-row__th">勤務開始</th>
                    <th class="table-row__th">勤務終了</th>
                    <th class="table-row__th">休憩時間</th>
                    <th class="table-row__th">勤務時間</th>
                </tr>
                {{-- 内容 --}}
                @foreach($userSlacks as $slack)
                <tr class="table-row">
                    <form action="/log.slack" method="get" class="table-row__form">
                        @csrf
                        <td class="table-row__item">
                            <p class="table-row__item-1">{{$slack->date}}</p>
                        </td>
                        <td class="table-row__item">
                            <p class="table-row__item-2">{{\Carbon\Carbon::parse($slack->start_time)->format('H:i:s')}}</p>
                        </td>
                        <td class="table-row__item">
                            <p class="table-row__item-3">{{\Carbon\Carbon::parse($slack->end_time)->format('H:i:s')}}</p>
                        </td>
                        <td class="table-row__item">
                            <p class="table-row__item-4">{{ $slack->totalRestTime }}</p>
                        </td>
                        <td class="table-row__item">
                            <p class="table-row__item-5">{{$slack->work_time }}</p>
                        </td>
                    </form>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
    {{-- ぺージネーション２ --}}
    <div class="page">
        <span class="page_count">
            {{ $userSlacks->appends(['user_id' => $currentUserId])->links('pagination::custom') }}
        </span>
    </div>

</div>


@endsection