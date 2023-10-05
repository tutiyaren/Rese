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
            <form action="{{ route('mypage.update', ['id' => $reservation->id]) }}" method="post" class="table">
                @method('PATCH')
                @csrf
                <table class="table-form">
                    <!-- 店名 -->
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Shop</th>
                        <td class="table-form__tr-td">{{ $reservation->shop->shop }}</td>
                    </tr>
                    <!--日付  -->
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Date</th>
                        <td class="table-form__tr-td">
                            <input type="date" name="date" id="date{{ $index }}" min="{{ $now->format('Y-m-d') }}" value="{{ $reservation->date }}" required class="date date{{ $index }}">
                        </td>
                    </tr>
                    <!-- 時間 -->
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Time</th>
                        <td class="table-form__tr-td">
                            <select name="time" id="time{{ $index }}" class="time time{{ $index }}" required>
                                <option disabled selected hidden>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</option>
                                @foreach ($futureTimes as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <!-- 人数 -->
                    <tr class="table-form__tr">
                        <th class="table-form__tr-th">Number</th>
                        <td class="table-form__tr-td">
                            <select name="number" id="number{{ $index }}" class="number number{{ $index }}" required>
                                <option disabled selected hidden>{{ $reservation->number }}</option>
                                @foreach($numbers as $number)
                                <option value="{{ $number }}">{{ $number }}人</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <p class="message">7名以上の方はこちらで予約せず、店舗に問い合わせをお願いします</p>
                <div class="update">
                    <!-- 予約日時が過去の場合のみレビューリンクを表示 -->
                    @if (\Carbon\Carbon::now() > \Carbon\Carbon::parse($reservation->date)->setTimeFromTimeString($reservation->time))
                    <a href="{{ route('review', ['id' => $reservation->shop->id]) }}" class="review">レビューへ</a>
                    @else
                    <button type="submit" class="update-submit">変更を保存</button>
                    @endif
                    <!-- QRコード -->
                    <a href="{{ route('generateQRCode',['id' => $reservation->id]) }}" class="update-qr"><i class="fa-solid fa-qrcode"></i></a>
                    <!-- Stripe -->
                    <a href="{{ route('stripe',['id' => $reservation->id]) }}" class="update-stripe"><i class="fa-brands fa-stripe-s"></i></a>
                </div>
            </form>
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
                    <img class="card-top__img" src="{{ asset('storage/' . $favoriteShop->shop->image) }}" alt="お店の画像">
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

<script>
    // 各入力欄の要素を取得
    const dateInputs = document.querySelectorAll('[id^="date"]');
    const timeInputs = document.querySelectorAll('[id^="time"]');
    const numberInputs = document.querySelectorAll('[id^="number"]');

    // 入力内容確認テーブルの要素を取得
    const dateConfirmation = document.getElementById('dateConfirmation');
    const timeConfirmation = document.getElementById('timeConfirmation');
    const numberConfirmation = document.getElementById('numberConfirmation');

    // 各予約ごとに日付の変更を監視
    dateInputs.forEach((dateInput, index) => {
        dateInput.addEventListener('input', function() {
            const selectedDate = new Date(dateInput.value);
            const currentDate = new Date();

            // 当該予約の日付が当日であるかどうかを確認
            if (
                selectedDate.getFullYear() === currentDate.getFullYear() &&
                selectedDate.getMonth() === currentDate.getMonth() &&
                selectedDate.getDate() === currentDate.getDate()
            ) {
                // 当日の場合、過去の時間を非表示にする
                const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
                const timeInput = timeInputs[index];

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
                const timeInput = timeInputs[index];

                for (const option of timeInput.options) {
                    option.style.display = 'block';
                }
            }

            // 時間選択肢を更新
            updateConfirmation();
        });
    });

    // 各入力欄の変更を監視
    timeInputs.forEach((timeInput, index) => {
        timeInput.addEventListener('change', function() {
            // 時間が変更されたらリアルタイムで確認内容を更新
            updateConfirmation();
        });
    });

    numberInputs.forEach((numberInput, index) => {
        numberInput.addEventListener('change', function() {
            // 人数が変更されたらリアルタイムで確認内容を更新
            updateConfirmation();
        });
    });

    // ページ読み込み時に初期値を表示
    updateConfirmation();

    // ページ読み込み時にデフォルトの時間非表示処理
    window.addEventListener('DOMContentLoaded', () => {
        dateInputs.forEach((dateInput, index) => {
            const selectedDate = new Date(dateInput.value);
            const currentDate = new Date();

            if (
                selectedDate.getFullYear() === currentDate.getFullYear() &&
                selectedDate.getMonth() === currentDate.getMonth() &&
                selectedDate.getDate() === currentDate.getDate()
            ) {
                const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
                const timeInput = timeInputs[index];

                for (const option of timeInput.options) {
                    const timeParts = option.value.split(':');
                    const optionTime = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);
                    if (optionTime < currentTime) {
                        option.style.display = 'none';
                    }
                }
            }
        });
    });

    // 各入力欄の値が変更されたときに実行する関数
    function updateConfirmation() {
        const selectedDate = new Date(dateInputs[0].value); // ここでは最初の予約の日付を取得しています
        const currentDate = new Date();

        // 当該予約の日付が当日であるかどうかを確認
        if (
            selectedDate.getFullYear() === currentDate.getFullYear() &&
            selectedDate.getMonth() === currentDate.getMonth() &&
            selectedDate.getDate() === currentDate.getDate()
        ) {
            // 当日の場合、過去の時間を非表示にする
            const currentTime = currentDate.getHours() * 60 + currentDate.getMinutes();
            const timeInput = timeInputs[0]; // ここでも最初の予約の時間を取得しています

            for (const option of timeInput.options) {
                const timeParts = option.value.split(':');
                const optionTime = parseInt(timeParts[0]) * 60 + parseInt(timeParts[1]);

                if (optionTime < currentTime) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            }
        }
    }
</script>

@endsection