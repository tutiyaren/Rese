<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests\RegisterRequest;


class RegisteredUserController extends Controller
{
    
    public function create()
    {
        return view('register');
    }
    public function store(RegisterRequest $request)
    {
        
    }

    
}
