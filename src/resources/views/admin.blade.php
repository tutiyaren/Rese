@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="admin">
    <div class="home">
        <a href="/admin/chart" class="home-link">店舗一覧</a>
        <a href="/admin/mail" class="home-link">お知らせメール</a>
    </div>
    <div class="admin__alert">
        @if(session('message'))
        <div class="admin__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <!-- 店舗代表者作成 -->
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

    <!-- 店舗情報作成 -->
    <div class="admin__alert csv">
        @if(session('success'))
        <div class="admin__alert--success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="shop-ttl">
        <h2 class="shop-ttl__top">店舗情報成</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="shop-inner">
        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSVファイルを選択してください:</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control">
            </div>
            <div class="submit">
                <button type="submit" class="submit-create">インポート</button>
            </div>
        </form>
    </div>
</div>

@endsection
