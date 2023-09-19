<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\User_Shop_Favorite;
use Carbon\Carbon;


class MypageController extends Controller
{
    //マイページGET
    public function mypage()
    {
        $user = Auth::user();
        //予約
        $reservations = $user->reservation()->with('shop')->get();
        //お気に入り
        $favoriteShops = User_Shop_Favorite::where('user_id', $user->id)->with('shop')->get();

        //予約時間選択肢
        $now = Carbon::now();
        $futureTimes = [];
        $interval = 30;
        for ($hour = 17; $hour <= 20; $hour++) {
            for ($minute = 0; $minute < 60; $minute += $interval) {
                $time = $now->setHour($hour)->setMinute($minute)->format('H:i');
                $futureTimes[] = $time;
            }
        }
        //予約人数選択肢
        $numbers = [];
        for ($i = 1; $i <= 6; $i++) {
            $numbers[] = $i;
        }

        return view('mypage', compact('reservations', 'favoriteShops', 'futureTimes', 'numbers', 'now'));
    }
    //予約消去POST
    public function delete($id)
    {
        $reservation = Reservation::find($id);
        if($reservation) {
            $reservation->delete();
        }

        return redirect('/mypage');
    }
    //予約変更PATCH
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        // フォームから送信されたデータで予約を更新
        $data = [
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
        ];

        // NULL値を避けるために、NULLでない値のみ更新する
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        $reservation->update($data);

        return redirect('/mypage');
    }
}
