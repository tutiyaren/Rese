@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_store.css') }}">
@endsection

@section('content')

<div class="store">
    <!-- 各お店の詳細 -->
    <div class="detail-shop">
        <div class="kind">
            <p class="kind-name"><a href="{{ url()->previous() }}" class="kind-back">&lt;</a>{{ $shop->shop }}</p>
        </div>
        <div class="img">
            <img src="{{ asset('storage/' . $shop->image) }}" alt="お店の画像" class="img-shop" id="shop-image">
        </div>
        <form action="/detail/{{ $shop->id }}/uploadImage" method="post" enctype="multipart/form-data" id="upload-form" style="display: none;">
            @csrf
            <input type="file" name="image" id="image-input" accept="image/*" required>
            <button type="submit" style="display: none;" id="upload-button">アップロード</button>
        </form>

        <div class="text">
            <span class="text-area">#{{ $shop->area }}</span><span class="text-genre">#{{ $shop->genre }}</span>
            <p class="text-content">{{ $shop->content }}</p>
        </div>

        <div class="chart">
            <a href="{{ route('chart') }}" class="chart-link">店舗一覧へ</a>
        </div>
    </div>
    <!-- 口コミ -->
    <div class="item">
        @if(session('message'))
        <div class="success">
            {{ session('message') }}
        </div>
        @endif
        <div class="all">
            <p class="all-voice">全ての口コミ情報</p>
        </div>
        <div class="cards">
            @foreach($otherUserReviews as $review)
            <div class="card">
                <form action="{{ route('erase', ['id' => $review->id, 'shop_id' => $shop->id]) }}" method="post" class="card-menu">
                    @method('DELETE')
                    @csrf
                    <button class="card-menu__delete-button">口コミを削除</button>
                </form>
                <!-- 口コミ内容 -->
                <div class="card-inner">
                    <div class="card-inner__review">
                        <p class="star-top">{{ $review->ratingComment() }}</p>
                        <!-- 星マーク -->
                        <div class="star-rating">
                            @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" @if($review->rating == $i) checked @endif>
                            <label for="star{{ $i }}" style="color: @if($review->rating >= $i) yellow @endif;">
                                <i class="fa-solid fa-star"></i>
                            </label>
                            @endfor
                        </div>
                        <!-- レビュー内容 -->
                        <p class="star-text">{{ $review->comment }}</p>
                        <!-- 写真・画像 -->
                        @if($review->image)
                        @if(file_exists(public_path('storage/public/images/' . $review->image)))
                        <!-- storage/public/imagesに画像が存在する場合 -->
                        <img class="voice-image" src="{{ asset('storage/public/images/' . $review->image) }}" alt="写真" width="80%">
                        @endif
                        @if(file_exists(public_path('storage/' . $review->image)))
                        <!-- storageに画像が存在する場合 -->
                        <img class="voice-image" src="{{ asset('storage/' . $review->image) }}" alt="写真" width="80%">
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection