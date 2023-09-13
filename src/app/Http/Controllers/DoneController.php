<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoneController extends Controller
{
    //予約完了
    public function done()
    {
        return view('done');
    }
    //サンクスページ
    public function thanks()
    {
        return view('thanks');
    }
}
