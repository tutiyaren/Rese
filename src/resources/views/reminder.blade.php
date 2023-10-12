@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reminder.css') }}">
@endsection

@section('content')

<div class="reminder">
    @foreach($reservations as $reservation)
    <p class="reminder-text">本日<span class="reminder-text__span">{{ $reservation->shop->shop }}</span>にて、<span class="reminder-text__span">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</span>より<span class="reminder-text__span">{{ $reservation->number }}名様</span>でご予約いただいております。</p>
    @endforeach
</div>

@endsection