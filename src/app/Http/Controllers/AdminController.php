<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;

class AdminController extends Controller
{
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
}
