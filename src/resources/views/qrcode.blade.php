@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">
@endsection

@section('content')

<div class="QRCode">
    <div class="QRCode-text">
        <p class="QRCode-text__ttl">ご来店された際に、<br>こちらのQRコードを店員にご提示ください<br>ご予約情報をこちらで確認、照合致します。</p>
    </div>
    <!-- QRコード -->
    <div class="QRCode-main">
        {!! QrCode::size(300)->color(0, 0, 255)->generate('http://localhost/generateQRCode/' . $reservation->id . '/indication'); !!}
    </div>
</div>


@endsection