<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function create()
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
