@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail">
    <!-- 各お店の詳細 -->
    <article class="detail-shop">
        <div class="kind">
            <p class="kind-name"><a href="{{ route('list') }}" class="kind-back">&lt;</a>{{ $shop->shop }}</p>
        </div>
        <div class="img">
            <img src="{{ $shop->image }}" alt="お店の画像" class="img-shop">
        </div>
        <div class="text">
            <span class="text-area">#{{ $shop->area }}</span><span class="text-genre">#{{ $shop->genre }}</span>
            <p class="text-content">{{ $shop->content }}</p>
        </div>
    </article>
    <!-- 予約 -->
    <article class="detail-reservation">
        <form method="post" action="/detail/{{ $shop->id }}/store" class="reservation">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="reservation-ttl">
                <p class="reservation-ttl__top">予約</p>
            </div>
            <!-- 入力 -->
            <div class="reservation-inner">
                <input type="date" name="date" value="{{ $now->format('Y-m-d') }}" min="{{ $now->format('Y-m-d') }}" class="reservation-inner__date" required>
                <br>
                <select name="time" class="reservation-inner__time" required>
                    @foreach ($futureTimes as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
                <br>
                <select name="number" class="reservation-inner__number" required>
                    <option value="1人">1人</option>
                    <option value="2人">2人</option>
                    <option value="3人">3人</option>
                    <option value="4人">4人</option>
                </select>
                <p class="reservation-inner__message">5人以上の方はこちらで予約せず、店舗にお問い合わせをお願いします</p>
            </div>
            <!-- 入力内容確認 -->
            <table class="reservation-table">
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Shop</th>
                    <td class="reservation-table__tr-td">{{ $shop->shop }}</td>
                </tr>
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Date</th>
                    <td class="reservation-table__tr-td">2023-09-28</td>
                </tr>
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Time</th>
                    <td class="reservation-table__tr-td">17:00</td>
                </tr>
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Number</th>
                    <td class="reservation-table__tr-td">2人</td>
                </tr>
            </table>
            <!-- 予約確定ボタン -->
            <div class="reservation-decision">
                @if(Auth::check())
                <button class="reservation-decision__submit" typa="submit">予約する</button>
                @else
                <a href="/guest" class="reservation-decision__login">ログインされた方のみ予約できます</a>
                @endif
            </div>
        </form>
    </article>
</div>

@endsection