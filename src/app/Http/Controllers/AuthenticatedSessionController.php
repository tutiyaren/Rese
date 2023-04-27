<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    
    public function store ()
    {
        return view('/login');
    }

    public function destroy ()
    {
        redirect('/login');
    }

}
