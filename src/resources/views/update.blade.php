@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}">
@endsection

@section('content')

<div class="update">
    <div class="update-ttl">
        <h2 class="update-ttl__top">店舗情報の更新</h2>
    </div>
    <form action="{{ route('refresh', ['id' => $representative->id, 'shop_id' => $shop->id]) }}" method="post" class="form" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <table class="form-table">
            <tr class="form-table__tr">
                <th class="form-table__tr-th line">店名</th>
                <th class="form-table__tr-th line">エリア</th>
                <th class=" form-table__tr-th">ジャンル</th>
            </tr>
            <tr class=" form-table__tr">
                <td class="form-table__tr-td line">
                    <input class="short" type=" text" name="shop" value="{{ $shop->shop }}" required>
                    @error('shop')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
                <td class="form-table__tr-td line">
                    <input class="short" type="text" name="area" value="{{ $shop->area }}" required>
                    @error('area')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
                <td class="form-table__tr-td">
                    <input class="short" type="text" name="genre" value="{{ $shop->genre }}" required>
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
                    <textarea class="text" name="content" cols="30" rows="10">{{ $shop->content }}</textarea>
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
                    <img id="shopImage" src="{{ $shop->image }}" alt="{{ basename($shop->image) }}" width=" 60%" height="60%">
                    <input class="file" type="file" name="image" id="newImageInput">
                    @error('image')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        </table>
        <div class="submit">
            <button class="submit-update" type="submit">変更を保存する</button>
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