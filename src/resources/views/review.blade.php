@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')

<dic class="review">
    <!-- 各お店の詳細 -->
    <article class="detail-shop">
        <div class="kind">
            <p class="kind-name"><a href="{{ url()->previous() }}" class="kind-back">&lt;</a>{{ $shop->shop }}</p>
        </div>
        <div class="img">
            <img src="{{ asset('storage/' . $shop->image) }}" alt="お店の画像" class="img-shop" id="shop-image">
        </div>
        <div class="text">
            <span class="text-area">#{{ $shop->area }}</span><span class="text-genre">#{{ $shop->genre }}</span>
            <p class="text-content">{{ $shop->content }}</p>
        </div>
    </article>

    <!-- 各店のレビュー -->
    <article class="review-wrap">
        <form action="/review/{{ $shop->id }}/store" method="post" class="review-form">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="review-ttl">
                <p class="review-ttl__top">レビュー</p>
            </div>
            <!-- 入力 -->
            <div class="review-inner">
                <!-- 星評価 -->
                <div class="review-inner__satisfaction">
                    <p class="review-inner__satisfaction-ttl">満足度</p>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5"><label for="star5"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2"><i class="fa-solid fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1"><i class="fa-solid fa-star"></i></label>
                    </div>
                    @error('rating')
                    <p class="error-rating">{{ $errors->first('rating') }}</p>
                    @enderror
                </div>
                <div class="review-inner__text">
                    <p class="review-inner__ttl">本文</p>
                    <textarea name="comment" id="comment" cols="25" rows="10" class="review-inner__comment" 　required></textarea>
                    @error('comment')
                    <p class="error-comment">{{ $errors->first('comment') }}</p>
                    @enderror
                </div>
            </div>
            <!-- レビュー送信ボタン -->
            <div class="review-decision">
                <button class="review-decision__submit" type="submit">送信する</button>
            </div>
        </form>
    </article>
</dic>

@endsection