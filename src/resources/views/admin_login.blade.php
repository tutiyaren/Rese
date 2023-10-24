@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
@endsection

@section('content')

<!-- ログイン -->
<div class="login">
    <div class="login-ttl">
        <h2 class="login-ttl__top">管理者Login</h2>
    </div>
    <form class="login-inner" method="post" action="{{ route('admin_login_submit') }}}">
        @csrf
        <div class="user">
            <!-- メールアドレス -->
            <div class="user-email">
                <i class="fa-solid fa-envelope icon"></i>
                <input type="email" name="email" class="user-email__input" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')
                <p class="error">※{{$errors->first('email')}}</p>
                @enderror
            </div>
            <!-- パスワード -->
            <div class="user-password">
                <i class="fa-solid fa-lock icon"></i>
                <input type="password" name="password" class="user-password__input" placeholder="Password" required>
                @error('password')
                <p class="error">※{{$errors->first('password')}}</p>
                @enderror
            </div>
        </div>
        <div class="button">
            <button class="button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>

@endsection