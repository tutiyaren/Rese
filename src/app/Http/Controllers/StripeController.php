<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    //StripeページGET
    public function stripe($id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($id);

        return view('stripe', compact('reservation'));
    }

    //StripeフォームPOST
    public function checkout()
    {
        

        return redirect('/payment');
    }


    //paymentページGET
    public function payment()
    {
        return view('payment');
    }
}
