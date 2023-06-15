@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/provisional.css')}}">
@endsection

@section('content')

<div class="main">
    <div class="top">
        <h2 class="ttl">仮登録画面</h2>
    </div>

    <form class="provisional" method="post" action="/provisional">
        @csrf
        <div class="input">
            <input type="email" class="email" placeholder="メールアドレス" name="email" value="{{old('email')}}">
        </div>
        @error('email')
        <div class="error">
            {{$errors->first('email')}}
        </div>
        @enderror
        <div class="input form-button">
            <button class="form-button__submit" type="submit">確認メールを送信</button>
        </div>
    </form>
    <div class="warm">
        <div class="warning">
            <h3 class="warning-ttl">※注意</h3>
            <div class="warning-inner">
                <p class="warning-inner__wait">ご入力いただいたメールアドレスに、本登録用URLを記載したメールをお送りいたします。</p>
            </div>
        </div>
    </div>
    <a href="/confirmation">confirmationへ</a>
</div>

@endsection