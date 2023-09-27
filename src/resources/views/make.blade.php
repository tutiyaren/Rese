@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/make.css') }}">
@endsection

@section('content')

<div class="make">
    <div class="make-ttl">
        <h2 class="make-ttl__top">店舗情報の作成</h2>
    </div>
    <form action="{{ route('produce', ['id' => $representative->id]) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <table class="form-table">
            <tr class="form-table__tr">
                <th class="form-table__tr-th line">店名</th>
                <th class="form-table__tr-th line">エリア</th>
                <th class=" form-table__tr-th">ジャンル</th>
            </tr>
            <tr class=" form-table__tr">
                <td class="form-table__tr-td line">
                    <input class="short" type=" text" name="shop" value="" placeholder="店名入力" required>
                    @error('shop')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
                <td class="form-table__tr-td line">
                    <input class="short" type="text" name="area" value="" placeholder="都道府県入力" required>
                    @error('area')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
                <td class="form-table__tr-td">
                    <input class="short" type="text" name="genre" value="" placeholder="ジャンル入力" required>
                    @error('genre')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr class="form-table__tr">
                <th class="form-table__tr-th" colspan="3">お店の詳細テキスト</th>
            </tr>
            <tr class="form-table__tr">
                <td class="form-table__tr-td" colspan="3">
                    <textarea class="text" name="content" cols="30" rows="10" placeholder="お店の詳細文を300字以内で入力"></textarea>
                    @error('content')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr class="form-table__tr">
                <th class="form-table__tr-th" colspan="3">お店の画像</th>
            </tr>
            <tr class="form-table__tr">
                <td class="form-table__tr-td" colspan="3">
                    <img id="shopImage" src="" alt="お店のサンプル画像" width=" 60%" height="60%">
                    <input class="file" type="file" name="image" id="newImageInput">
                    @error('image')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        </table>
        <div class="submit">
            <button class="submit-make" type="submit">店舗情報を作成する</button>
        </div>
    </form>

</div>

<script>
    const newImageInput = document.getElementById('newImageInput');

    const shopImage = document.getElementById('shopImage');

    newImageInput.addEventListener('change', (event) => {

        const selectedFile = event.target.files[0];

        const reader = new FileReader();
        reader.onload = function(e) {
            shopImage.src = e.target.result;
        };
        reader.readAsDataURL(selectedFile);
    });
</script>

@endsection