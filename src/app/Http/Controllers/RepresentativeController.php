<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;
use App\Models\Shop;
use App\Models\Reservation;
use App\Http\Requests\ShopUpdateRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class RepresentativeController extends Controller
{
    public function show()
    {
        return view('representative_login');
    }

    public function login(LoginRequest $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('representatives')->attempt($credentials)) {

            return redirect()->route('representative', ['id' => Auth::guard('representatives')->id()]); // ログインしたらリダイレクト

        }

        return back()->withInput($request->only('email'))
        ->withErrors([
            'email' => ['認証情報が記録と一致しません。']
        ]);
    }


    //店舗代表者トップページ
    public function representative($id)
    {
        $representative = Representative::findOrFail($id);
        $shops = $representative->shops;

        return view('representative', compact('shops', 'representative'));
    }

    //店舗代表者予約一覧ページ
    public function booking($id, $shop_id)
    {
        $representative = Representative::findOrFail($id);
        $shops = $representative->shops;
        
        // 特定の店舗情報を取得
        $shop = Shop::findOrFail($shop_id);
        
        // 店名を新しい変数に代入
        $shop_name = $shop->shop;

        $reservations = Reservation::where('shop_id', $shop->id)-> orderBy('date', 'asc')->orderBy('time', 'asc')->get();        

        return view('booking', compact('shops', 'shop','reservations', 'shop_name'));
    }


    //店舗代表者更新ページ
    public function update($id, $shop_id)
    {
        $representative = Representative::findOrFail($id);
        $shops = $representative->shops;

        // 特定の店舗情報を取得
        $shop = Shop::findOrFail($shop_id);

        // 店名を新しい変数に代入
        $shop_name = $shop->shop;

        return view('update', compact('shops', 'shop','shop_name', 'representative'));
    }

    //店舗代表者更新
    public function refresh(ShopUpdateRequest $request, $id, $shop_id)
    {
        // リクエストからフォームデータを取得
        $data = $request->validated();

        // 特定の店舗情報を取得
        $shop = Shop::findOrFail($shop_id);

        // 更新処理
        $shop->update([
            'shop' => $data['shop'],
            'area' => $data['area'],
            'genre' => $data['genre'],
            'content' => $data['content'],
        ]);

        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');

            // ファイル名を取得
            $fileName = $uploadedImage->getClientOriginalName();

            // 画像を保存ディレクトリに移動
            $imagePath = $uploadedImage->storeAs('public/images', $fileName);

            // データベースにファイル名を保存
            $shop->update(['image' => $fileName]);
        }

        return redirect()->route('representative', ['id' => $id]);
    }


    //店舗情報作成ページ
    public function make($id)
    {
        $representative = Representative::findOrFail($id);

        return view('make', compact('representative'));
    }

    //店舗情報作成
    public function produce(ShopUpdateRequest $request, $id)
    {
        $data = $request->only(['shop', 'area', 'genre', 'content', 'image']);

        $data['representative_id'] = $id;

        if ($request->hasFile('image')) {
            // アップロードされた画像ファイル名を取得
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->getClientOriginalName();

            // 画像を保存ディレクトリに移動
            $uploadedImage->storeAs('public/images', $imageName);

            // 画像ファイル名をデータに追加
            $data['image'] = $imageName;
        }

        Shop::create($data);

        return redirect()->route('representative', ['id' => $id]);
    }
}
