@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reminder.css') }}">
<title>予約リマインダー</title>
@endsection

@section('content')

<div class="reminder">
    <div class="reminder-inner">
        @if($reservations->isNotEmpty())
        @foreach($reservations as $reservation)
        <p class="reminder-inner__content">本日、<span class="reminder-inner__content-reservation">{{ $reservation->shop->shop }}</span>にて<span class="reminder-inner__content-reservation">{{ $reservation->time }}</span>より<span class="reminder-inner__content-reservation">{{ $reservation->number }}</span>名様でご予約を頂いております。</p>
        @endforeach
        @else
        <p class="reminder-inner__content">本日、「店名」にて「時間」より「人数」名様でご予約を頂いております。</p>
        @endif
    </div>
</div>

@endsection