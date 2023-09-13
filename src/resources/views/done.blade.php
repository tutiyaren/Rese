@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')

<div class="card">
    <div class="card-text">
        <h2 class="card-text__thanks">ご予約ありがとうございます</h2>
    </div>
    <div class="card-back">
        <a href="/" class="card-back__button">戻る</a>
    </div>
</div>

@endsection