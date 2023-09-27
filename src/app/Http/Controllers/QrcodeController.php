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

        // QRコードのテキストデータを予約情報に基づいて生成
        $text = "予約ID: {$reservation->id}\n店名: {$reservation->shop->shop}\n日付: {$reservation->date} 時間: {$reservation->time}";

        // QRコードを生成
        $qrCode = QrCode::size(300)->generate($text);

        // 生成したQRコードをビューに渡す
        return view('qr_code', compact('qrCode', 'reservation'));
    }
}
