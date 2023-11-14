@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/voice.css') }}">
@endsection

@section('content')

<div class="voice">
    <div class="voice-inner">
        <!-- 左・お店 -->
        <div class="voice-left">
            <div class="voice-left__ttl">
                <h2 class="voice-left__ttl-top">今回のご利用はいかがでしたか？</h2>
            </div>
            <div class="voice-left__card">
                <div class="card-top">
                    <img class="card-top__img" src="{{ asset('storage/' . $selectedShop->image) }}" alt="お店の画像">
                </div>
                <div class="card-bottom">
                    <div class="shop">
                        <p class="shop-name">{{ $selectedShop->shop }}</p>
                        <div class="shop-area">
                            <p class="shop-area__place">#{{ $selectedShop->area }}</p>
                            <p class="shop-area__genre">#{{ $selectedShop->genre }}</p>
                        </div>
                    </div>
                    <div class="detail">
                        <a href="{{ route('detail', ['id' => $selectedShop->id]) }}" class="detail-see">詳しく見る</a>
                        @if(Auth::check())
                        <form method="post" action="{{ route('favorite.toggle',  ['id' => $selectedShop->id]) }}" class="detail-favorite">
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
        </div>

        <!-- 右・口コミ -->
        <div class="voice-right">
            <form action="/voice/{{ $selectedShop->id }}/messenger" method="post" class="voice-right__form" enctype="multipart/form-data">
                @csrf
                <!-- 星評価 -->
                <div class="star">
                    <h3 class="star-ttl">体験を評価してください</h3>
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
                <!-- 口コミ -->
                <div class="comment">
                    <h3 class="comment-ttl">口コミを投稿</h3>
                    <textarea name="comment" id="comment" cols="40" rows="10" class="comment-inner" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment') }}</textarea>
                    @error('comment')
                    <p class="error-comment">{{ $errors->first('comment') }}</p>
                    @enderror
                    <p class="comment-max">0/400(最高文字数)</p>
                </div>
                <!-- 画像 -->
                <div class="image">
                    <h3 class="image-ttl">画像の追加</h3>
                    <div class="image-upload" id="image-drop-area">
                        <label for="image-upload" class="image-upload-label">
                            クリックして写真を追加<br>またはドラッグアンドドロップ
                        </label>
                        <input type="file" id="image-upload" name="image" accept="image/*" style="display:none">
                        <img id="image-preview" src="" alt="写真プレビュー" style="display: none; max-width: 100%">
                    </div>
                    @error('image')
                    <p class="error-image">{{ $errors->first('image') }}</p>
                    @enderror
                </div>
                <!-- 投稿ボタン -->
                <div class="voice-button">
                    <button class="voice-button__submit" type="submit">口コミを投稿</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // ファイルが選択されたときの処理
    document.getElementById('image-upload').addEventListener('change', function(e) {
        var input = e.target;
        var label = input.previousElementSibling;
        var file = input.files[0];
        var imagePreview = document.getElementById('image-preview');

        if (file) {
            // 選択されたファイルが存在する場合、ファイルをプレビューに表示
            label.textContent = '選択中: ' + file.name;
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        } else {
            // ファイルが選択されていない場合、プレビューを非表示にし、元のラベルを表示
            label.textContent = 'クリックして写真を追加<br>またはドロッグアンドドロップ';
            imagePreview.style.display = 'none';
        }
    });


    var imageDropArea = document.getElementById('image-drop-area');
    var label = document.querySelector('.image-upload-label');

    // ドラッグオーバー時の処理
    imageDropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        imageDropArea.classList.add('dragover');
        label.textContent = 'ドロップして写真をアップロード';
    });

    // ドラッグリーブ時の処理
    imageDropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        imageDropArea.classList.remove('dragover');
        label.textContent = 'クリックして写真を追加<br>またはドラッグアンドドロップ';
    });

    // ドロップ時の処理
    imageDropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        imageDropArea.classList.remove('dragover');

        var files = e.dataTransfer.files;
        if (files.length > 0) {
            var file = files[0];
            var imagePreview = document.getElementById('image-preview');

            label.textContent = '選択中: ' + file.name;
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        }
    });

    // コメント
    var commentTextarea = document.getElementById('comment');
    var commentMax = document.querySelector('.comment-max');

    commentTextarea.addEventListener('input', function() {
        var text = commentTextarea.value;
        var currentLength = text.length;
        var maxLength = 400; // 最大文字数

        if (currentLength <= maxLength) {
            commentMax.textContent = currentLength + '/' + maxLength + '(最高文字数)';
        } else {
            commentMax.style.color = 'red';
        }
    });
</script>

@endsection