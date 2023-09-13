@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<!-- ユーザー名前 -->
<div class="name">
    <h2 class="name-ttl">testさん</h2>
</div>
<div class="mypage">
    <!-- 予約状況 -->
    <article class="reservation">
        <div class="reservation-ttl">
            <h3 class="reservation-ttl__item">予約状況</h3>
        </div>
        <div class="reservation-inner">
            <form method="post" action="" class="form">
                @csrf
                <div class="form-head">
                    <span class="form-head__timer"><i class="fa-solid fa-clock clock"></i>予約１</span>
                    <button type="submit" class="form-head__delete"><i class="fa-solid fa-xmark delete"></i></button>
                </div>
            </form>
            <!-- 予約内容 -->
            <form method="get" action="" class="table">
                @csrf
                <table class="table-form">
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Shop</th>
                        <td class="table-form__tr-td">仙人</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Date</th>
                        <td class="table-form__tr-td">2023-09-30</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Time</th>
                        <td class="table-form__tr-td">17:00</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Number</th>
                        <td class="table-form__tr-td">2人</td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="reservation-inner">
            <form method="post" action="" class="form">
                @csrf
                <div class="form-head">
                    <span class="form-head__timer"><i class="fa-solid fa-clock clock"></i>予約１</span>
                    <button type="submit" class="form-head__delete"><i class="fa-solid fa-xmark delete"></i></button>
                </div>
            </form>
            <!-- 予約内容 -->
            <form method="get" action="" class="table">
                @csrf
                <table class="table-form">
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Shop</th>
                        <td class="table-form__tr-td">仙人</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Date</th>
                        <td class="table-form__tr-td">2023-09-30</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Time</th>
                        <td class="table-form__tr-td">17:00</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Number</th>
                        <td class="table-form__tr-td">2人</td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="reservation-inner">
            <form method="post" action="" class="form">
                @csrf
                <div class="form-head">
                    <span class="form-head__timer"><i class="fa-solid fa-clock clock"></i>予約１</span>
                    <button type="submit" class="form-head__delete"><i class="fa-solid fa-xmark delete"></i></button>
                </div>
            </form>
            <!-- 予約内容 -->
            <form method="get" action="" class="table">
                @csrf
                <table class="table-form">
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Shop</th>
                        <td class="table-form__tr-td">仙人</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Date</th>
                        <td class="table-form__tr-td">2023-09-30</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Time</th>
                        <td class="table-form__tr-td">17:00</td>
                    </tr>
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Number</th>
                        <td class="table-form__tr-td">2人</td>
                    </tr>
                </table>
            </form>
        </div>
    </article>
    <!-- お気に入り店舗 -->
    <article class="favorite">
        <div class="favorite-ttl">
            <h3 class="favorite-ttl__item">お気に入り店舗</h3>
        </div>
        <div class="favorite-cards">

            <div class="card">
                <div class="card-top">
                    <img class="card-top__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="お店の画像">
                </div>
                <div class="card-bottom">
                    <div class="shop">
                        <p class="shop-name">仙人</p>
                        <div class="shop-area">
                            <p class="shop-area__place">#東京都</p>
                            <p class="shop-area__genre">#寿司</p>
                        </div>
                    </div>
                    <div class="detail">
                        <a href="/detail" class="detail-see">詳しく見る</a>
                        <form method="" action="" class="detail-favorite">
                            @csrf
                            <button class="detail-favorite__submit" type="submit"><i class="fa-solid fa-heart heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-top">
                    <img class="card-top__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="お店の画像">
                </div>
                <div class="card-bottom">
                    <div class="shop">
                        <p class="shop-name">仙人</p>
                        <div class="shop-area">
                            <p class="shop-area__place">#東京都</p>
                            <p class="shop-area__genre">#寿司</p>
                        </div>
                    </div>
                    <div class="detail">
                        <a href="/detail" class="detail-see">詳しく見る</a>
                        <form method="" action="" class="detail-favorite">
                            @csrf
                            <button class="detail-favorite__submit" type="submit"><i class="fa-solid fa-heart heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-top">
                    <img class="card-top__img" src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="お店の画像">
                </div>
                <div class="card-bottom">
                    <div class="shop">
                        <p class="shop-name">仙人</p>
                        <div class="shop-area">
                            <p class="shop-area__place">#東京都</p>
                            <p class="shop-area__genre">#寿司</p>
                        </div>
                    </div>
                    <div class="detail">
                        <a href="/detail" class="detail-see">詳しく見る</a>
                        <form method="" action="" class="detail-favorite">
                            @csrf
                            <button class="detail-favorite__submit" type="submit"><i class="fa-solid fa-heart heart"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </article>
</div>

@endsection