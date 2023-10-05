<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StateController extends Controller
{
    //客
    public function guest()
    {
        return view('guest');
    }
    //会員
    public function member()
    {
        return view('member');
    }
}
