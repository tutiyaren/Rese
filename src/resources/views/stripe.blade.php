@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

<div class="stript">
    <form action="{{ route('stripe.checkout', ['id' => $reservation->id]) }}" method="post" class="stripe-form">
        @csrf
        <div class="form-row">
            <label for="card-element">
                クレジットカード情報
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <div class="stripe-form__submit">
            <button class="stripe-form__submit-button" type="submit">支払いの送信</button>
        </div>
    </form>
</div>

<!-- Stripe.jsを直接追加 -->
<script src="https://js.stripe.com/v3/"></script>

<!-- Stripe.jsのカードエレメントを設定 -->
<script>
    var stripe = Stripe('pk_test_51Nt7NJKrYhCL6ylZDpmk6LAPj1b82n9h2vgFSfiAkKroCZNXWhEE48XkGlYh6pXxnAwfP9xzFOBXxqhwBEwNV3pR00MA3Uwd9l');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
    // カードエレメントをフォームに追加
    cardElement.mount('#card-element');

    // カード情報が変更されたときのイベントリスナー
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // フォームが送信されたときの処理
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // クライアントサイドでカード情報をトークン化
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // エラーが発生した場合、エラーメッセージを表示
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // トークンが正常に生成された場合、フォームにトークンを追加し、サーバーに送信
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                // フォームを送信
                form.submit();
            }
        });
    });
</script>


@endsection