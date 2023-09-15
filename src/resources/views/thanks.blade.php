@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-text">
        <h2 class="card-text__thanks">ログイン、または会員登録ありがとうございます</h2>
    </div>
    <div class="card-login">
        <a href="/login" class="card-login__button">ホーム画面へ</a>
    </div>
</div>

@endsection