<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use App\Models\Shop;
use App\Models\Voice;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin_login');
    }

    public function login(LoginRequest $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admins')->attempt($credentials)) {

            return redirect('admin'); // ログインしたらリダイレクト

        }

        return back()->withInput($request->only('email'))
            ->withErrors([
                'email' => ['認証情報が記録と一致しません。']
            ]);
    }
    
    //店舗代表者作成
    public function admin()
    {
        return view('admin');
    }

    public function create(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);

        Representative::create($data);

        return redirect('admin')->with('message', '店舗代表者を作成しました');
    }

    //お知らせメール
    public function mail()
    {
        return view('mail.admin_mail');
    }

    public function sendUserNotification(Request $request)
    {
        $userEmail = $request->input('user_email');
        $message = $request->input('message');

        // メールを送信
        Mail::raw($message, function ($mail) use ($userEmail) {
            $mail->to($userEmail)->from('abc@example.com', 'abc')->subject('お知らせメール');
        });

        return redirect()->back()->with('message', 'お知らせメールが送信されました');
    }

    // 店舗一覧ページ
    public function chart()
    {
        $shops = Shop::all();

        return view('admin_chart', (compact('shops')));
    }

    // 店舗詳細
    public function store($id)
    {
        //特定の店舗の予約view
        $shop = Shop::findOrFail($id);

        $userId = Auth::id();

        // 他のユーザーの口コミを取得
        $otherUserReviews = Voice::where('shop_id', $shop->id)->get();

        return view('admin_store', compact('shop', 'otherUserReviews'));
    }

    // 店舗ごとの口コミ消去
    public function erase($id, Request $request )
    {
        $voice = Voice::find($id); // 口コミを特定
        $voice->delete(); // 口コミを削除

        return redirect()->back()->with('message', '削除しました');
    }
}
