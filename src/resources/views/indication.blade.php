@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/indication.css') }}">
@endsection

@section('content')

<table class="table">
    <tr class="table-tr">
        <th class="table-tr__th">店名</th>
        <td class="table-tr__td">{{ $reservation->shop->shop }}</td>
    </tr>
    <tr class="table-tr">
        <th class="table-tr__th">日付</th>
        <td class="table-tr__td">{{ $reservation->date }}</td>
    </tr>
    <tr class="table-tr">
        <th class="table-tr__th">時間</th>
        <td class="table-tr__td">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
    </tr>
    <tr class="table-tr">
        <th class="table-tr__th">人数</th>
        <td class="table-tr__td">{{ $reservation->number }}</td>
    </tr>
</table>


@endsection