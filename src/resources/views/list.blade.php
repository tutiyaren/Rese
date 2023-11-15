@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('search')
<div class="sort">
    <!-- ソート機能 -->
    <form action="{{ route('list') }}" method="get" class="sort-form">
        @csrf
        <label for="sort_by" class="sort-form__label">並び替え：</label>
        <select class="sort-form__select" name="sort_by" id="sort_by" onchange="this.form.submit()">
            <option value="" selected disabled hidden>評価高/低</option>
            <option value="random">ランダム</option>
            <option value="high-rating">評価が高い順</option>
            <option value="low-rating">評価が低い順</option>
        </select>
    </form>
</div>
<!-- header-right -->
<div class="squeeze">
    <form action="{{ route('list') }}" method="get" class="squeeze-form">
        @csrf
        <!-- エリア検索 -->
        <select name="area" id="area" class="squeeze-area">
            <option value="All area">All area</option>
            @foreach($uniqueAreas as $areaOption)
            <option value="{{ $areaOption }}" {{ $areaOption == $area ? 'selected' : '' }}>{{ $areaOption }}</option>
            @endforeach
        </select>
        <!-- ジャンル検索 -->
        <select name="genre" id="genre" class="squeeze-genre">
            <option value="All genre">All genre</option>
            @foreach($uniqueGenres as $genreOption)
            <option value="{{ $genreOption }}" {{ $genreOption == $genre ? 'selected' : '' }}>{{ $genreOption }}</option>
            @endforeach
        </select>
        <!-- キーワード検索 -->
        <input type="text" name="keyword" value="{{ request('keyrowd') }}" placeholder="Search…" class="squeeze-search">
    </form>
</div>
@endsection

@section('content')
<!-- お店一覧 -->
<div class="cards">
    @foreach($shops as $shop)
    <div class="card">
        <div class="card-top">
            <img class="card-top__img" src="{{ $shop->image }}" alt="お店の画像">
        </div>
        <div class="card-bottom">
            <div class="shop">
                <p class="shop-name">{{ $shop->shop }}</p>
                <div class="shop-area">
                    <p class="shop-area__place">#{{ $shop->area }}</p>
                    <p class="shop-area__genre">#{{ $shop->genre }}</p>
                </div>
            </div>
            <div class="detail">
                <a href="{{ route('detail', ['id' => $shop->id]) }}" class="detail-see">詳しく見る</a>
                @if(Auth::check())
                <form method="post" action="{{ route('favorite.toggle',  ['id' => $shop->id]) }}" class="detail-favorite">
                    @csrf
                    <button class="detail-favorite__submit" type="submit">
                        @if ($favoriteExists[$shop->id])
                        <i class="fa-solid fa-heart heart-red"></i>
                        @else
                        <i class="fa-solid fa-heart heart"></i>
                        @endif
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection