@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')

<div class="main">
    <div class="top">
        <h2 class="ttl">会員登録</h2>
    </div>

    <form class="register" method="post" action="/register">
        @csrf
        <div class="input">
            <input type="text" class="name" placeholder="名前" name="name" value="{{old('name')}}">
        </div>
        @error('name')
        <div class="error">
            {{$errors->first('name')}}
        </div>
        @enderror
        <div class="input">
            <input type="email" class="email" placeholder="メールアドレス" name="email" value="{{old('email')}}">
        </div>
        @error('email')
        <div class="error">
            {{$errors->first('email')}}
        </div>
        @enderror
        <div class="input">
            <input type="password" class="password" placeholder="パスワード" name="password">
        </div>
        @error('password')
        <div class="error">
            {{$errors->first('password')}}
        </div>
        @enderror
        <div class="input">
            <input type="password" class="password" placeholder="確認用パスワード" name="password_confirmation">
        </div>
        <div class="input form-button">
            <button class="form-button__submit" type="submit">会員登録</button>
        </div>

    </form>

    <div class="have">
        <p class="have-text">アカウントをお持ちの方はこちらから</p>
        <a href="" class="have-login">ログイン</a>
    </div>

</div>

@endsection