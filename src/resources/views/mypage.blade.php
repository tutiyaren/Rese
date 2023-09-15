@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<!-- ユーザー名前 -->
<div class="name">
    <h2 class="name-ttl">{{Auth::user()->name}}さん</h2>
</div>
<div class="mypage">
    <!-- 予約状況 -->
    <article class="reservation">
        <div class="reservation-ttl">
            <h3 class="reservation-ttl__item">予約状況</h3>
        </div>
        @foreach ($reservations as $index => $reservation)
        <div class="reservation-inner">
            <form method="post" action="{{ route('mypage.delete', ['id' => $reservation->id]) }}" class="form">
                @csrf
                @method('DELETE')
                <div class="form-head">
                    <span class="form-head__timer"><i class="fa-solid fa-clock clock"></i>予約 {{ $index + 1 }}</span>
                    <button type="submit" class="form-head__delete"><i class="fa-solid fa-xmark delete"></i></button>
                </div>
            </form>
            <!-- 予約内容 -->
            <div class="table">
                @csrf
                <table class="table-form">
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Shop</th>
                        <td class="table-form__tr-td">{{ $reservation->shop->shop }}</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Date</th>
                        <td class="table-form__tr-td">{{ $reservation->date }}</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Time</th>
                        <td class="table-form__tr-td">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Number</th>
                        <td class="table-form__tr-td">{{ $reservation->number }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </article>
    <!-- お気に入り店舗 -->
    <article class="favorite">
        <div class="favorite-ttl">
            <h3 class="favorite-ttl__item">お気に入り店舗</h3>
        </div>
        <div class="favorite-cards">
            @foreach($favoriteShops as $favoriteShop)
            <div class="card">
                <div class="card-top">
                    <img class="card-top__img" src="{{ $favoriteShop->shop->image }}" alt="お店の画像">
                </div>
                <div class="card-bottom">
                    <div class="shop">
                        <p class="shop-name">{{ $favoriteShop->shop->shop }}</p>
                        <div class="shop-area">
                            <p class="shop-area__place">#{{ $favoriteShop->shop->area }}</p>
                            <p class="shop-area__genre">#{{ $favoriteShop->shop->genre }}</p>
                        </div>
                    </div>
                    <div class="detail">
                        <a href="{{ route('detail', ['id' => $favoriteShop->shop->id]) }}" class=" detail-see">詳しく見る</a>
                        <form method="post" action="{{ route('favorite.toggle', ['id' => $favoriteShop->shop->id]) }}" class="detail-favorite">
                            @csrf
                            <button class="detail-favorite__submit" type="submit"><i class="fa-solid fa-heart heart heart-red"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </article>
</div>

@endsection