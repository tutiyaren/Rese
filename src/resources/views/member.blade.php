@extends('layouts.back')

@section('css')
<link rel="stylesheet" href="{{ asset('css/member.css') }}">
@endsection

@section('content')

<div class="select">
    @csrf
    <p class="select-move"><a href="/" class="select-home">Home</a></p>
    <form method="post" action="/logout" class="select-logout">
        @csrf
        <button class="select-button">Logout</button>
    </form>
    @if(auth()->check())
    <p class="select-move"><a href="/mypage" class="select-mypage">Mypage</a></p>
    @endif
</div>

@endsection