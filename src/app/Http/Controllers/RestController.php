<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slack;
use App\Models\Rest;
use Carbon\Carbon;

class RestController extends Controller
{
    //休憩開始
    public function start_rest(Request $request)
    {
        $user_id = $request->user()->id;
        $slack_id = $request->input('slack_id');
        $existing_record = Rest::where('user_id', $user_id)->where('slack_id', $slack_id)->first();

        $rest = new Rest();
        $rest->user_id = $user_id;
        $rest->slack_id = $slack_id;
        $rest->start_rest = Carbon::now();
        $rest->end_rest = null;
        $rest->time_rest = null;
        $rest->save();

        
        return redirect('/');
    }
    //休憩終了
    public function end_rest(Request $request)
    {
        $user_id = $request->user()->id;
        $slack_id = $request->input('slack_id');
        $existing_record = Rest::where('user_id', $user_id)->where('slack_id', $slack_id)->first();

        if (!$existing_record || $existing_record->end_time !== null || !$existing_record->start_rest || $existing_record->end_rest !== null) {
            return redirect('/');
        }

        $existing_record->end_rest = Carbon::now();
        $existing_record->time_rest = $existing_record->start_rest->diff($existing_record->end_rest)->format('%H:%I:%S');
        $existing_record->save();


        return redirect('/');
    }
}
