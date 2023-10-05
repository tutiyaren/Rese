@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')

<div class="booking">
    <div class="booking-ttl">
        <h2 class="booking-ttl__reservation">予約一覧</h2>
        <h2 class="booking-ttl__shop">{{ $shop_name }}</h2>
    </div>
    <table class="table">
        <tr class="table-tr">
            <th class="table-tr__th date">日付</th>
            <th class="table-tr__th time">時間</th>
            <th class="table-tr__th number">人数</th>
        </tr>
        @foreach($reservations as $reservation)
        <tr class="table-tr">
            <td class="table-tr__td date">{{ $reservation->date }}</td>
            <td class="table-tr__td time">{{ date('H:i', strtotime($reservation->time)) }}</td>
            <td class="table-tr__td number">{{ $reservation->number }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection