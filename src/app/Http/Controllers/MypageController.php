<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\User_Shop_Favorite;


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

        return view('mypage', compact('reservations', 'favoriteShops'));
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
}
