@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-text">
        <h2 class="card-text__thanks">決済完了いたしました。<br>ご利用ありがとうございました。</h2>
    </div>
    <div class="card-back">
        <a href="/mypage" class="card-back__button">戻る</a>
    </div>
</div>

@endsection