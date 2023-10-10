<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;

class QrcodeController extends Controller
{

    public function generateQrCode($id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($id);

        // 生成したQRコードをビューに渡す
        return view('qrcode', compact('reservation'));
    }

    public function indication ($id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($id);

        return view('indication', compact('reservation'));
    }
}
