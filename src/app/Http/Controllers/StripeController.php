<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;


class StripeController extends Controller
{
    //StripeページGET
    public function stripe(Request $request, $id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($id);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $intent = PaymentIntent::create([
            'amount' => 100,  // 金額を設定
            'currency' => 'JPY',  // 通貨を設定
            'payment_method_types' => ['card'], // 支払い方法をカードに限定する
        ]);

        return view('stripe', compact('reservation', 'intent'));
    }

    //StripeフォームPOST
    public function checkout(Request $request)
    {
        return redirect()->route('payment');
    }

    //paymentページGET
    public function payment()
    {
        return view('payment');
    }
}
