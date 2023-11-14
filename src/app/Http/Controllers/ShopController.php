<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\User_Shop_Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use App\Models\Voice;

class ShopController extends Controller
{
    //飲食店一覧GET
    public function list(Request $request)
    {
        $area = $request->input('area');
        $genre = $request->input('genre');
        $keyword = $request->input('keyword');

        $query = Shop::search($keyword);
        // エリア、ジャンルでの検索スコープを適用
        $query->area($area);
        $query->genre($genre);

        $shops = $query->get();

        // ソート
        if ($request->has('sort_by')) {
            $sortType = $request->input('sort_by');

            if ($sortType === 'random') {
                $shops = $shops->shuffle();
            } elseif ($sortType === 'high-rating') {
                $shops = $shops->sortByDesc(function ($shop) {
                    return $shop->voices->avg('rating') ?? 0;
                });
            } elseif ($sortType === 'low-rating') {
                $shops = $shops->sortBy(function ($shop) {
                    return $shop->voices->avg('rating') ?? 0;
                });
            }
        }

        //重複無しのエリアとジャンルの選択肢
        $uniqueAreas = Shop::distinct()->pluck('area');
        $uniqueGenres = Shop::distinct()->pluck('genre');

        // お気に入り
        $favoriteExists = [];
        foreach ($shops as $shop) {
            $exists = User_Shop_Favorite::where('user_id', Auth::id())
                ->where('shop_id', $shop->id)
                ->exists();

            $favoriteExists[$shop->id] = $exists;
        }

        return view('list', compact('shops', 'uniqueAreas', 'uniqueGenres', 'area','genre', 'favoriteExists'));
    }
    
    //飲食店一覧のお気に入りPOST
    public function favorite($id)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();
    
        // User_Shop_Favorite テーブルで指定のユーザーとお店のお気に入り情報を取得
        $favorite = User_Shop_Favorite::where('user_id', $userId)
            ->where('shop_id', $id)
            ->first();

        if ($favorite) {
            // お気に入りが存在する場合、削除
            $favorite->delete();
        } else {
            // お気に入りが存在しない場合、追加
            User_Shop_Favorite::create([
                'user_id' => $userId,
                'shop_id' => $id,
            ]);
        }

        return redirect()->back();
    }

    //飲食店詳細GET
    public function detail($id)
    {
        //特定の店舗の予約view
        $shop = Shop::findOrFail($id);
        
        $userId = Auth::id();

        // ログインしているユーザーの該当店舗の口コミを取得
        $userReviews = Voice::where('shop_id', $shop->id)
        ->where('user_id', $userId)
        ->get();

        // 他のユーザーの口コミを取得
        $otherUserReviews = Voice::where('shop_id', $shop->id)
        ->where('user_id', '!=', $userId)
        ->get();

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

        return view('detail', compact('shop', 'userReviews', 'now', 'futureTimes','numbers', 'otherUserReviews'));
    }

    // 口コミ削除
    public function delete($voice_id)
    {
        $review = Voice::find($voice_id);

        if ($review) {
            $review->delete();
        }
        return redirect()->back();
    }

    //飲食店詳細の予約フォームPOST
    public function store(ReservationRequest $request)
    {
        $shopId = $request->input('shop_id');
        $user = Auth::user();
        //テーブルに予約情報追加
        $reservationData = [
            'user_id' => $user->id,
            'shop_id' => $shopId,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => (int)$request->input('number'),
        ];
        Reservation::create($reservationData);
        
        return redirect()->route('done');   
    }
}
