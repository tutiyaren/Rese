@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/send.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-text">
        <h2 class="card-text__thanks">レビューありがとうございます</h2>
    </div>
    <div class="card-back">
        <a href="{{ route('mypage') }}" class="card-back__button">戻る</a>
    </div>
</div>

@endsection