@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_mail.css') }}">
@endsection

@section('content')
<div class="mail">
    <div class="home">
        <a href="/admin" class="home-link">店舗代表者作成</a>
    </div>

    @if(session('message'))
    <div class="success">
        <p class="success-mail">{{ session('message') }}</p>
    </div>
    @endif

    <div class="mail-ttl">
        <h2 class="mail-ttl__top">お知らせメール送信</h2>
    </div>

    <form class="mail-form" method="POST" action="/admin/sendnotification">
        @csrf
        <div class="form-group">
            <label for="user_email">送信先のメールアドレス</label>
            <input type="email" name="user_email" class="form-group__mail" required value="{{ old('user_email') }}">
        </div>

        <div class="form-group">
            <label for="message">内容</label>
            <textarea name="message" class="form-group__content" required row="20" cols="40">{{ old('message') }}</textarea>
        </div>

        <div class="submit">
            <button type="submit" class="submit-button">メールを送信</button>
        </div>
    </form>
</div>
@endsection