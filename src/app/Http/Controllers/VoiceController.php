<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\VoiceRequest;
use App\Models\User_Shop_Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Voice;
use Illuminate\Support\Facades\Storage;

class VoiceController extends Controller
{
    public function voice($id, Request $request)
    {
        //特定の店舗の予約view
        $selectedShop = Shop::findOrFail($id);
        
        $keyword = $request->input('keyword');

        $query = Shop::search($keyword);
        $shops = $query->get();
        // お気に入り
        $favoriteExists = [];
        foreach ($shops as $shop) {
            $exists = User_Shop_Favorite::where('user_id', Auth::id())
            ->where('shop_id', $shop->id)
            ->exists();

            $favoriteExists[$shop->id] = $exists;
        }

        return view('voice', compact('selectedShop', 'favoriteExists', 'shop'));
    }

    // 口コミ追加
    public function messenger(VoiceRequest $request, $id)
    {
        $validatedData = $request->validated();
        // ログインユーザーのIDを取得
        $userId = Auth::id();
        $imageName = null;
        if ($request->hasFile('image')) {
            // アップロードされた画像ファイル名を取得
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->getClientOriginalName();

            // 画像を保存ディレクトリに移動
            $uploadedImage->storeAs('public/images', $imageName);
        }

        // データベースに口コミを登録
        Voice::create([
            'user_id' => $userId,
            'shop_id' => $id,
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'],
            'image' => $imageName,
        ]);

        return redirect()->route('detail', ['id' => $id]);
    }

    // 口コミ編集ページ
    public function change($id, Request $request)
    {
        $selectedShop = Shop::findOrFail($id);  // 特定の店舗を取得

        $userId = Auth::id();

        // ログインしているユーザーの、特定の口コミ情報を取得
        $userReview = Voice::where('shop_id', $selectedShop->id)
        ->where('user_id', $userId)
        ->first(); 

        $keyword = $request->input('keyword');

        $query = Shop::search($keyword);
        $shops = $query->get();
        $favoriteExists = [];

        foreach ($shops as $shop) {
            $exists = User_Shop_Favorite::where('user_id', Auth::id())
                ->where('shop_id', $shop->id)
                ->exists();

            $favoriteExists[$shop->id] = $exists;
        }

        return view('change', compact('shop', 'selectedShop', 'favoriteExists', 'userReview'));
    }

    // 口コミ編集
    public function renewal($shop_id, $id, VoiceRequest $request)
    {
        $userReview = Voice::findOrFail($id); // 更新する口コミ情報を取得

        // フォームからのデータで口コミ情報を更新
        $userReview->rating = $request->input('rating');
        $userReview->comment = $request->input('comment');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);

            $userReview->image = $imageName; // 画像情報を更新
        }

        $userReview->save(); // 更新を保存 

        return redirect()->route('detail', ['id' => $shop_id]);
    }

}
