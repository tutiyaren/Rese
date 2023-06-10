@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')

<div class="main">
    <div class="top">
        <h2 class="ttl">ログイン</h2>
    </div>

    <form class="login" method="post" action="/login">
        @csrf
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
        <div class="input form-button">
            <button class="form-button__submit" type="submit">ログイン</button>
        </div>

    </form>

    <div class="have">
        <p class="have-text">アカウントをお持ちでない方はこちらから</p>
        <a href="{{route('register')}}" class="have-not-login">会員登録</a>
    </div>

</div>

@endsection