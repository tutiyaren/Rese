@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/confirmation.css')}}">
@endsection

@section('content')

<div class="main">
    <div class="top">
        <h2 class="ttl">仮登録受付</h2>
    </div>

    <div class="confi">
        <p class="confi-end">仮登録を受け付けました。</p>
        <p class="confi-wait">※本登録はまだ完了していません。</p>
    </div>

    <div class="message">
        <p class="message-inner">登録されたメールアドレスに、<br>本登録用のURLが記載されたメールを送信いたしました。</p>
        <p class="message-text">メールの内容を確認し、URLから本登録を完了してください。</p>
    </div>

    <a href="/provisional">provisionalへ</a>
</div>

@endsection