<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    //マイページ
    public function mypage()
    {
        return view('mypage');
    }
}
