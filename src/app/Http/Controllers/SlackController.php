<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slack;
use App\Models\Users;
use Carbon\Carbon;

class SlackController extends Controller
{
    public function work()
    {
        $slacks = Slack::with('users')->get();
        $users = Users::all();
        return view('engrave', compact('slacks', 'users'));
    }
    public function work_time(Request $request)
    {
        $slacks = $request->only(['users_id', 'date', 'start_time', 'end_time', 'break_time', 'working']);

        Slack::create($slacks);
        
        return redirect('/', compact('slacks'));
    }

    public function work_start(Request $request)
    {
        $work = new Slack();
        $work->users_id = $request->user()->id;
        $work->start_time = Carbon::now();
        $work->save();

        return redirect('/');
    }

    public function work_end(Request $request)
    {
        $work = Slack::where('users_id', $request->user()->id)
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($work) {
            $work->end_time = Carbon::now();
            $work->save();

            return redirect();
        }
    }


    public function data()
    {
        return view('attendance');
    }
}
