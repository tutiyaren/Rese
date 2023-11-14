@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail">
    <!-- 各お店の詳細 -->
    <article class="detail-shop">
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

        <!-- 口コミ -->
        <div class="voice">
            @if ($userReviews->isEmpty())
            <a href="{{ route('voice', ['id' => $shop->id]) }}" class="voice-link">口コミを投稿する</a>
            @endif
        </div>

        <div class="all">
            <p class="all-voice">全ての口コミ情報</p>
        </div>
        <div class="cards">
            @if($userReviews->isNotEmpty())
            <div class="card">
                <!-- 自身の口コミ -->
                <div class="card-menu">
                    <div class="card-menu__update">
                        <a href="{{ route('change', ['shop_id' => $userReviews[0]->shop_id, 'id' => $userReviews[0]->id]) }}" class="card-menu__update-button">口コミを編集</a>
                    </div>
                    <form action="{{ route('delete', ['voice' => $userReviews[0]->id]) }}" method="post" class="card-menu__delete">
                        @method('DELETE')
                        @csrf
                        <button class="card-menu__delete-button">口コミを削除</button>
                    </form>
                </div>
                <!-- 口コミ内容 -->
                <div class="card-inner">
                    <div class="card-inner__review">
                        <p class="star-top">{{ $userReviews[0]->ratingComment() }}</p>
                        <!-- 星マーク -->
                        <div class="star-rating">
                            @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" @if($userReviews[0]->rating == $i) checked @endif>
                            <label for="star{{ $i }}" style="color: @if($userReviews[0]->rating >= $i) yellow @endif;">
                                <i class="fa-solid fa-star"></i>
                            </label>
                            @endfor
                        </div>
                        <!-- レビュー内容 -->
                        <p class="star-text">{{ $userReviews[0]->comment }}</p>
                        <!-- 写真・画像 -->
                        @if($userReviews[0]->image)
                        @if(file_exists(public_path('storage/public/images/' . $userReviews[0]->image)))
                        <!-- storage/public/imagesに画像が存在する場合 -->
                        <img class="voice-image" src="{{ asset('storage/public/images/' . $userReviews[0]->image) }}" alt="写真" width="80%">
                        @endif
                        @if(file_exists(public_path('storage/' . $userReviews[0]->image)))
                        <!-- storageに画像が存在する場合 -->
                        <img class="voice-image" src="{{ asset('storage/' . $userReviews[0]->image) }}" alt="写真" width="80%">
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @foreach($otherUserReviews as $review)
            <div class="card">
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
                <!-- 日付入力 -->
                <input type="date" name="date" id="date" min="{{ $now->format('Y-m-d') }}" value="{{ $now->format('Y-m-d') }}" class="reservation-inner__date" required>
                <br>
                <!-- 時間入力 -->
                <select name="time" id="time" class="reservation-inner__time" required>
                    <option disabled selected hidden>時間を選択</option>
                    @foreach ($futureTimes as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
                @error('time')
                <p class="error-time">{{ $errors->first('time') }}</p>
                @enderror
                <br>
                <!-- 人数入力 -->
                <select name="number" id="number" class="reservation-inner__number" required>
                    <option disabled selected hidden>人数を選択</option>
                    @foreach($numbers as $number)
                    <option value="{{ $number }}">{{ $number }}人</option>
                    @endforeach
                </select>
                <p class="reservation-inner__message">7名以上の方はこちらで予約せず、店舗に問い合わせをお願いします</p>
                @error('number')
                <p class="error-number">{{ $errors->first('number') }}</p>
                @enderror
            </div>
            <!-- 入力内容確認 -->
            <table class="reservation-table">
                <!-- 店名確認 -->
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Shop</th>
                    <td class="reservation-table__tr-td">{{ $shop->shop }}</td>
                </tr>
                <!-- 日付確認 -->
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Date</th>
                    <td class="reservation-table__tr-td" id="dateConfirmation"></td>
                </tr>
                <!-- 時間確認 -->
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Time</th>
                    <td class="reservation-table__tr-td" id="timeConfirmation"></td>
                </tr>
                <!-- 人数確認 -->
                <tr class="reservation-table__tr">
                    <th class="reservation-table__tr-th">Number</th>
                    <td class="reservation-table__tr-td" id="numberConfirmation"></td>
                </tr>
            </table>
            <!-- 予約確定ボタン -->
            <div class="reservation-decision">
                @if(Auth::check())
                <button class="reservation-decision__submit" type="submit">予約する</button>
                @else
                <a href="/guest" class="reservation-decision__login">ログインされた方のみ予約できます</a>
                @endif
            </div>
        </form>
    </article>
</div>

<script>
    // 画像をクリックするとファイル選択
    const shopImage = document.getElementById('shop-image');
    const imageInput = document.getElementById('image-input');
    const uploadButton = document.getElementById('upload-button');

    shopImage.addEventListener('click', function() {
        imageInput.click();
    });

    // ファイルが選択されたらフォームを自動的に送信
    imageInput.addEventListener('change', function() {
        uploadButton.click(); // ファイルが選択されたらフォームを送信
    });


    // 各入力欄の要素を取得
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const numberInput = document.getElementById('number');

    // 入力内容確認テーブルの要素を取得
    const dateConfirmation = document.getElementById('dateConfirmation');
    const timeConfirmation = document.getElementById('timeConfirmation');
    const numberConfirmation = document.getElementById('numberConfirmation');

    // 各入力欄の値が変更されたときに実行する関数
    function updateConfirmation() {
        dateConfirmation.textContent = dateInput.value;
        timeConfirmation.textContent = timeInput.options[timeInput.selectedIndex].text;
        numberConfirmation.textContent = numberInput.options[numberInput.selectedIndex].text;
    }

    // 日付の変更を監視
    dateInput.addEventListener('input', function() {
        const selectedDate = new Date(dateInput.value);
        const currentDate = new Date();

        // 日付が当日かどうかを確認
        if (
            selectedDate.getFullYear() === currentDate.getFullYear() &&
            selectedDate.getMonth() === currentDate.getMonth() &&
            selectedDate.getDate() === currentDate.getDate()
        ) {
            // 当日の場合、過去の時間を非表示にする
            const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
            for (const option of timeInput.options) {
                const timeParts = option.value.split(':');
                const optionTime = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);

                if (optionTime < currentTime) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            }
        } else {
            // 翌日以降の場合、すべての時間を表示する
            for (const option of timeInput.options) {
                option.style.display = 'block';
            }
        }

        // 時間選択肢を更新
        updateConfirmation();
    });

    // 各入力欄の変更を監視
    timeInput.addEventListener('change', function() {
        // 時間が変更されたらリアルタイムで確認内容を更新
        updateConfirmation();
    });

    numberInput.addEventListener('change', function() {
        // 人数が変更されたらリアルタイムで確認内容を更新
        updateConfirmation();
    });

    // ページ読み込み時に初期値を表示
    updateConfirmation();

    // ページ読み込み時にデフォルトの時間非表示処理
    window.addEventListener('DOMContentLoaded', () => {
        const currentDate = new Date();
        const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
        for (const option of timeInput.options) {
            const timeParts = option.value.split(':');
            const optionTime = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);
            if (optionTime < currentTime) {
                option.style.display = 'none';
            }
        }
    });
</script>

@endsection