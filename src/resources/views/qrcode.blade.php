@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/QRCode.css') }}">
@endsection

@section('content')

<div class="QRCode">
    <div class="QRCode-text">
        <p class="QRCode-text__ttl">ご来店された際に、<br>こちらのQRコードを店員にご提示ください<br>ご予約情報をこちらで確認、照合致します。</p>
    </div>
    <!-- QRコード -->
    <div class="QRCode-main">
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" />
    </div>
</div>


@endsection