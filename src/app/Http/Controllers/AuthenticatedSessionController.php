<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;


class AuthenticatedSessionController extends Controller
{
    public function create(Request $request)
    {
        
    }
    
    public function store (Request $request)
    {
        return view('/login');
    }

    public function destroy (LoginRequest $request)
    {
        redirect('/login');
    }

}
