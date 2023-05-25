@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/users.css')}}">
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

    <div class="user">

        <div class="user-ttl">
            <h2 class="user-ttl__name">従業員検索</h2>
        </div>
        <form action="" method="get" class="search">
            @csrf
            <div class="search-item">
                <input type="text" name="name" value="{{ request()->input('name')}}" class="search-item__input">
            </div>
            <div class="search-button">
                <button class="search-button__submit" type="submit">検索</button>
            </div>
        </form>

        <div class="table">
            @if ($users->isEmpty())
            <p class="error">※　<span class="error-in">該当する従業員がいません</span></p>
            @endif
            <table class="table-inner">
                {{-- タイトル --}}
                <tr class="table-row">
                    <th class="table-row__th">名前</th>
                    <th class="table-row__th">勤怠一覧へ</th>
                </tr>
                {{-- 内容 --}}
                @foreach($users as $user)
                <tr class="table-row">
                    {{-- 名前 --}}
                    <td class="table-row__td">
                        <div class="name-list">
                            <form action="{{ route('log.diligence', ['user_id' => $user->id]) }}" method="get" class="name-list__form">
                                <p class="name-list__p">{{ $user->name }}</p>
                            </form>
                        </div>
                    </td>
                    {{-- 勤怠一覧へ --}}
                    <td class="table-row__td">
                        <div class="diligence-list">
                            <a href="{{ route('log.diligence', ['user_id' => $user->id]) }}" class="diligence-list__link">&#9094;</a>
                            <input type="hidden" name="" value="">
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
    {{-- ぺージネーション２ --}}
    <div class="page">
        <span class="page_count">
            {{ $users->links('pagination::custom') }}
        </span>
    </div>

</div>
@endsection