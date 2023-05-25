<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slack;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class UsersController extends Controller
{
    public function users(Request $request)
    {
        $perPage = 5;
        $keyword = $request->input('name');

        $users = User::KeywordSearch($keyword)->paginate($perPage);
        
        return view('users', compact('users'));
    }
}
