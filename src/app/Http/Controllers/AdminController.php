<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;

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
        Mail::to($userEmail)->send(new UserNotification($message));

        return redirect()->back()->with('message', 'お知らせメールが送信されました');
    }
}
