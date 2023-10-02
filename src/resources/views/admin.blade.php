@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="admin">
    <div class="home">
        <a href="/admin/mail" class="home-link">お知らせメール</a>
    </div>
    <div class="admin__alert">
        @if(session('message'))
        <div class="admin__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="admin-ttl">
        <h2 class="admin-ttl__top">店舗代表者作成</h2>
    </div>
    <div class="admin-inner">
        <form action="{{ route('create') }}" method="post" class="form">
            @csrf
            <label for="name" class="label">名前:
                <input type="text" name="name" id="name" required class="input name">
            </label>

            <label for="email" class="label">メールアドレス:
                <input type="email" name="email" id="email" required class="input email">
            </label>

            <label for="password" class="label">パスワード:
                <input type="password" name="password" id="password" required class="input password">
            </label>

            <div class="submit">
                <button type="submit" class="submit-create">代表者を作成</button>
            </div>
        </form>
    </div>
</div>

@endsection