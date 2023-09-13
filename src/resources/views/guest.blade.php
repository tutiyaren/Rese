@extends('layouts.back')

@section('css')
<link rel="stylesheet" href="{{ asset('css/guest.css') }}">
@endsection

@section('content')

<div class="select">
    <p class="select-move"><a href="/" class="select-home">Home</a></p>
    <p class="select-move"><a href="/register" class="select-registration">Registration</a></p>
    <p class="select-move"><a href="/login" class="select-login">Login</a></p>
</div>

@endsection