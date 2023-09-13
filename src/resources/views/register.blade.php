@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<!-- 会員登録 -->
<div class="register">
    <div class="register-ttl">
        <h2 class="register-ttl__top">Registration</h2>
    </div>
    <form class="register-inner" method="post" action="/register">
        @csrf
        <div class="user">
            <!-- 名前 -->
            <div class="user-name">
                <i class="fa-solid fa-user icon"></i>
                <input type="text" name="name" class="user-name__input" value="{{ old('name') }}" placeholder="Username" required>
                @error('name')
                <p class="error">{{$errors->first('name')}}</p>
                @enderror
            </div>
            <!-- メールアドレス -->
            <div class="user-email">
                <i class="fa-solid fa-envelope icon"></i>
                <input type="email" name="email" class="user-email__input" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')
                <p class="error">{{$errors->first('email')}}</p>
                @enderror
            </div>
            <!-- パスワード -->
            <div class="user-password">
                <i class="fa-solid fa-lock icon"></i>
                <input type="password" name="password" class="user-password__input" placeholder="Password" required>
                @error('password')
                <p class="error">{{$errors->first('password')}}</p>
                @enderror
            </div>
            <!-- 確認パスワード -->
            <div class="user-password__confirmation">
                <i class="fa-solid fa-lock icon"></i>
                <input type="password" name="password_confirmation" class="user-password_confirmation__input" placeholder="Password_confirmation" required>
                @error('password')
                <p class="error">{{$errors->first('password')}}</p>
                @enderror
            </div>
        </div>
        <div class="button">
            <button class="button-submit" type="submit">登録</button>
        </div>
    </form>
</div>

@endsection