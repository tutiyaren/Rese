@extends('layouts.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

<div class="stripe">
    <form action="{{ route('stripe.checkout', ['id' => $reservation->id]) }}" method="post" class="stripe-form" id="payment-form">
        @csrf
        <div class="stripe-form__inner">
            <label for="card_email">メールアドレス</label>
            <div class="email">
                <input class="email-input" type="email" id="card_email" name="card_email" required>
            </div>
        </div>
        <div class="stripe-form__inner">
            <label for="card_number">カード番号</label>
            <div id="card_number" class="inner number"></div>
        </div>
        <div class="stripe-form__inner">
            <label for="card_expiry">有効期限</label>
            <div id="card_expiry" class="inner expiry"></div>
        </div>
        <div class="stripe-form__inner">
            <label for="card_security">セキュリティコード</label>
            <div id="card_security" class="inner security"></div>
        </div>
        <button id="submit" class="submit">支払い</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/stripe.js') }}"></script>

<script>
    var stripe = Stripe('pk_test_51Nt7NJKrYhCL6ylZDpmk6LAPj1b82n9h2vgFSfiAkKroCZNXWhEE48XkGlYh6pXxnAwfP9xzFOBXxqhwBEwNV3pR00MA3Uwd9l');
    var elements = stripe.elements();

    var cardEmail = document.getElementById('card_email');

    // カード番号
    var cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card_number');
    cardNumber.addEventListener('change', function(event) {
        var displayError = document.getElementById('card_errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // 有効期限
    var cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card_expiry');
    cardExpiry.addEventListener('change', function(event) {
        var displayError = document.getElementById('card_errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // セキュリティコード
    var cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card_security');
    cardCvc.addEventListener('change', function(event) {
        var displayError = document.getElementById('card_errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // フォームの送信処理を追加
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var errorElement = document.getElementById('card_errors');

        stripe.createPaymentMethod({
            type: 'card',
            card: cardNumber,
        }).then(function(result) {
            if (result.error) {
                errorElement.textContent = result.error.message;
            } else {
                // 成功時の処理
                // result.paymentMethodに支払い方法が含まれています
                // ここでサーバーに送信して支払いを確定できます

                // トークンを取得
                var paymentMethod = result.paymentMethod.id;

                // サーバーに送信
                fetch('YOUR_SERVER_ENDPOINT', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // LaravelのCSRFトークンを送信
                        },
                        body: JSON.stringify({
                            payment_method: paymentMethod,
                            // 他の必要なデータをここに追加
                        }),
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        // サーバーからの応答を処理
                        if (data.success) {
                            // 支払いが成功した場合の処理
                            // 顧客に成功メッセージを表示し、リダイレクトなどを行う
                        } else {
                            // 支払いが失敗した場合の処理
                            errorElement.textContent = '支払いに失敗しました。';
                        }
                    })
                    .catch(function(error) {
                        console.error('エラー:', error);
                    });
            }
        });
    });

    function stripeSubmit(token) {
        var form = document.getElementById('form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);

        // メールアドレスの値を追加
        var emailInput = document.createElement('input');
        emailInput.setAttribute('type', 'hidden');
        emailInput.setAttribute('name', 'card_email');
        emailInput.setAttribute('value', cardEmail.value);

        form.appendChild(hiddenInput);
        form.appendChild(emailInput);

        form.submit();
    }

    document.addEventListener("DOMContentLoaded", function() {
        var submitButton = document.getElementById("submit");
        var form = document.getElementById("payment-form");

        submitButton.addEventListener("click", function(event) {
            event.preventDefault(); // デフォルトのフォーム送信をキャンセル

            // ここでカード情報のバリデーションなどを行う

            // フォームが有効であれば送信
            if (isFormValid()) {
                form.submit();
            }
        });

        // フォームのバリデーションを行う関数
        function isFormValid() {
            // ここでカード番号、有効期限、セキュリティコードのバリデーションを行う
            // バリデーションが成功した場合は true を返し、エラーがある場合は false を返す

            var cardEmail = document.getElementById("card_email").value;
            var cardNumber = document.getElementById("card_number").textContent; // カード番号
            var cardExpiry = document.getElementById("card_expiry").textContent; // 有効期限
            var cardSecurity = document.getElementById("card_security").textContent; // セキュリティコード

            // カード情報のバリデーションを行うロジックをここに追加

            return true; // バリデーションが成功した場合に true を返す
        }
    });
</script>
@endsection