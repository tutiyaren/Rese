<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        return view('/register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $request->all();
        Users::create($user);
        redirect('/register');
    }

    public function provisional()
    {
        return view('/provisional');
    }

    public function confirmation()
    {
        return view('/confirmation');
    }
}
