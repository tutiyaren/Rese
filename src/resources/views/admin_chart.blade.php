@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_chart.css') }}">
@endsection

@section('content')

<div class="chart">
    <table class="chart-list">
        <tr class="chart-list__tr">
            <th class="chart-list__tr-th">ID</th>
            <th class="chart-list__tr-th">店舗名</th>
            <th class="chart-list__tr-th">エリア</th>
            <th class="chart-list__tr-th">ジャンル</th>
            <th class="chart-list__tr-th">店舗詳細へ</th>
        </tr>
        @foreach($shops as $shop)
        <tr class="chart-list__tr">
            <td class="chart-list__tr-td">{{ $shop->id }}</td>
            <td class="chart-list__tr-td">{{ $shop->shop }}</td>
            <td class="chart-list__tr-td">{{ $shop->area }}</td>
            <td class="chart-list__tr-td">{{ $shop->genre }}</td>
            <td class="chart-list__tr-td"><a href="{{ route('store', ['id' => $shop->id]) }}" class="link"><i class="fa-solid fa-arrow-right" style="color: #0e5add;"></i></a></td>
        </tr>
        @endforeach

    </table>
</div>

@endsection