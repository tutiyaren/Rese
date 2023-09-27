@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

<div class="stript">
    <form action="{{ route('stripe.checkout', ['id' => $reservation->id]) }}" method="post" class="stripe-form">
        @csrf

        <div class="stripe-form__submit">
            <button class="stripe-form__submit-button" type="submit">支払いの送信</button>
        </div>
    </form>
</div>


@endsection