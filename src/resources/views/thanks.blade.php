@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-text">
        <h2 class="card-text__thanks">会員登録ありがとうございます</h2>
    </div>
    <div class="card-login">
        <a href="/login" class="card-login__button">ログインする</a>
    </div>
</div>

@endsection