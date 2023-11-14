@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css') }}">
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
                    <!-- 写真・画像 -->
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
            <form action="{{ route('voice.renewal', ['id' => $userReview->id, 'shop_id' => $selectedShop]) }}" method="post" class="voice-right__form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <!-- 星評価 -->
                <div class="star">
                    <h3 class="star-ttl">体験を評価してください</h3>
                    <div class="star-rating">
                        @if($userReview && $userReview->rating)
                        @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" @if($userReview->rating == $i) checked @endif>
                        <label for="star{{ $i }}" style="color: @if($userReview->rating >= $i) yellow @endif;">
                            <i class="fa-solid fa-star"></i>
                        </label>
                        @endfor
                        @endif
                    </div>
                    @error('rating')
                    <p class="error-rating">{{ $errors->first('rating') }}</p>
                    @enderror
                </div>
                <!-- 口コミ -->
                <div class="comment">
                    <h3 class="comment-ttl">口コミを投稿</h3>
                    <textarea name="comment" id="comment" cols="40" rows="10" class="comment-inner" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ $userReview->comment ?? ''  }}</textarea>
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
                            クリックして写真を変更<br>またはドラッグアンドドロップ
                        </label>
                        <input type="file" id="image-upload" name="image" accept="image/*" style="display:none">
                        <!-- 写真・画像 -->
                        @if($userReview && $userReview->image)
                        @if(file_exists(public_path('storage/public/images/' . $userReview->image)))
                        <!-- storage/public/imagesに画像が存在する場合 -->
                        <img id="image-preview-public" src="{{ asset('storage/public/images/' . $userReview->image) }}" alt="" style="width: 100%; display: none;">
                        <img id="image-preview-public-none" src="{{ asset('storage/public/images/' . $userReview->image) }}" alt="" style="width: 100%;">
                        @endif
                        @if(file_exists(public_path('storage/' . $userReview->image)))
                        <!-- storageに画像が存在する場合 -->
                        <img id="image-preview" src="{{ asset('storage/' . $userReview->image) }}" alt="" style="width: 100%; display: none;">
                        <img id="image-preview-none" src="{{ asset('storage/' . $userReview->image) }}" alt="" style="width: 100%;">
                        @endif
                        @endif
                    </div>
                    @error('image')
                    <p class="error-image">{{ $errors->first('image') }}</p>
                    @enderror
                </div>
                <!-- 投稿ボタン -->
                <div class="voice-button">
                    <button class="voice-button__submit" type="submit">口コミを更新</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // 元
    document.addEventListener("DOMContentLoaded", function() {
        var imagePreview = document.getElementById('image-preview');
        var imagePreviewPublic = document.getElementById('image-preview-public');
        var imagePreviewNone = document.getElementById('image-preview-none');
        var imagePreviewPublicNone = document.getElementById('image-preview-public-none');

        var updateDefaultPreview = function() {
            imagePreview.style.display = 'none';
            imagePreviewNone.style.display = 'block';
            imagePreviewPublic.style.display = 'none';
            imagePreviewPublicNone.style.display = 'block';
        };

        if (!imagePreview || !imagePreview.complete || imagePreview.naturalHeight === 0) {
            if (!imagePreviewPublic || !imagePreviewPublic.complete || imagePreviewPublic.naturalHeight === 0) {
                updateDefaultPreview();
            }
            $('#image-upload').hide();
        }

        var updateImagePreview = function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).show();
                $('#image-preview-none').hide();
                $('#image-preview-public').attr('src', e.target.result).show();
                $('#image-preview-public-none').hide();
            };
            reader.readAsDataURL(file);
        };

        $('#image-upload').on('change', function(e) {
            var file = e.target.files[0];
            if (file) {
                updateImagePreview(file);
            } else {
                updateDefaultPreview();
            }
        });

        var imageDropArea = document.getElementById('image-drop-area');
        var label = document.querySelector('.image-upload-label');

        imageDropArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            imageDropArea.classList.add('dragover');
            label.textContent = 'ドロップして写真をアップロード';
        });

        imageDropArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            imageDropArea.classList.remove('dragover');
            label.textContent = 'クリックして写真を追加<br>またはドラッグアンドドロップ';
        });

        imageDropArea.addEventListener('drop', function(e) {
            e.preventDefault(); // ここでデフォルトの挙動を停止する
            imageDropArea.classList.remove('dragover');

            var files = e.dataTransfer.files;
            if (files.length > 0) {
                var file = files[0];
                label.textContent = '選択中: ' + file.name;
                updateImagePreview(file);
            }
        });
    });

    // ファイルが選択されたときの処理　追加
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
    document.addEventListener("DOMContentLoaded", function() {
        var commentTextarea = document.getElementById('comment');
        var commentMax = document.querySelector('.comment-max');

        // ページ読み込み時にコメントのデフォルト文字数をカウントして表示
        var defaultComment = commentTextarea.value;
        var defaultLength = defaultComment.length;
        var maxLength = 400; // 最大文字数

        commentMax.textContent = defaultLength + '/' + maxLength + '(最高文字数)';

        commentTextarea.addEventListener('input', function() {
            var text = commentTextarea.value;
            var currentLength = text.length;

            if (currentLength <= maxLength) {
                commentMax.textContent = currentLength + '/' + maxLength + '(最高文字数)';
            } else {
                commentMax.textContent = currentLength + '/' + maxLength + '(最高文字数)';
                commentMax.style.color = 'red';
            }
        });
    });

    // スター
    document.addEventListener("DOMContentLoaded", function() {
        const labels = document.querySelectorAll('.star-rating label');

        labels.forEach(label => {
            label.addEventListener('click', function() {
                const radio = label.previousElementSibling;
                radio.checked = true;
                const rating = parseInt(radio.value);

                labels.forEach(lbl => {
                    const starValue = parseInt(lbl.getAttribute('for').replace('star', ''));
                    lbl.style.color = starValue <= rating ? 'yellow' : '#ccc';
                });
            });
        });
    });
</script>

@endsection