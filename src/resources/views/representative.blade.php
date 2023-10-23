@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative.css') }}">
@endsection

@section('content')

<div class="representative">
    <div class="representative-cards">
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
                <div class="wrap">
                    <a href="{{ route('update', ['id' => $representative->id, 'shop_id' => $shop->id]) }}" class="wrap-update">更新</a>
                    <a href="{{ route('booking', ['id' => $representative->id, 'shop_id' => $shop->id]) }}" class="wrap-reservation">予約一覧</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="card">
            <div class="card-create">
                <a href="{{ route('make', ['id' => $representative->id]) }}" class="card-create__shop">店舗情報作成</a>
            </div>
        </div>
        <div class="card">
            <div class="card-create">
                <a href="{{ route('reminder', ['id' => $representative->id]) }}" class="card-create__shop">リマインダー</a>
            </div>
        </div>
    </div>
</div>

@endsection