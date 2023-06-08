<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slack;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;


class SlackController extends Controller
{
    //ホーム画面
    public function work()
    {
        $user_id = auth()->id();
        $today = Carbon::now()->format('Y-m-d');
        $existing_record = Slack::where('user_id', $user_id)->where('date', $today)->first();
        $rest_records = $existing_record ? $existing_record->rests : null;

        $working = ($existing_record && !$existing_record->end_time && !$existing_record->start_rest && !$existing_record->end_rest) ? true : false;

        $slacks = Slack::with('users')->get();

        $number1 = ($existing_record && $existing_record->start_time && (!$existing_record->end_rest || !$existing_record->end_time)) ? true : false;

        $number2 = ($existing_record && $existing_record->start_time && $existing_record->start_rest && !$existing_record->end_rest) ? true : false;

        $number3 = ($existing_record && !$existing_record->start_rest) ? true : false;


        return view('engrave', compact('slacks', 'existing_record', 'working', 'rest_records', 'number1', 'number2', 'number3'));
    }
    //勤務開始
    public function work_start(Request $request)
    {
        $user_id = $request->user()->id;
        $today = Carbon::now()->format('Y-m-d');
        $existing_record = Slack::where('user_id', $user_id)->where('date', $today)->first();

        if($existing_record) {
            return redirect('/');
        }

        $work = new Slack();
        $work->user_id = $user_id;
        $work->start_time = Carbon::now();
        $work->date = $today;
        $work->end_time = null;
        $work->save();

        return redirect('/');
    }
    //勤務終了
    public function work_end(Request $request)
    {
        $user_id = $request->user()->id;
        $today = Carbon::now()->format('Y-m-d');
        $existing_record = Slack::where('user_id', $user_id)->where('date', $today)->first();

        if(!$existing_record || $existing_record->end_time !== null) {
            return redirect('/');
        }

        if ($existing_record->start_rest && !$existing_record->end_rest) {
            return redirect('/');
        }

        $existing_record->end_time = Carbon::now();
        $existing_record->time_work = Carbon::parse($existing_record->start_time)->diff($existing_record->end_time)->format('%H:%I:%S');
        $existing_record->save();

        return redirect('/');
    }
    //休憩開始
    public function start_rest(Request $request)
    {
        $user_id = $request->user()->id;
        $slack_id = $request->input('slack_id');
        $existing_record = Rest::where('user_id', $user_id)->where('slack_id', $slack_id)->whereNull('end_time')->first();

        if ($existing_record) {
            return redirect('/');
        }
        
        $rest = new Rest();
        $rest->user_id = $user_id;
        $rest->slack_id = $slack_id;
        $rest->start_rest = Carbon::now();
        $rest->end_rest = null;
        $rest->time_rest = null;
        $rest->end_time = null;
        $rest->save();

        $number3 = true;

        return redirect('/');
    }
    //休憩終了
    public function end_rest(Request $request)
    {
        $user_id = $request->user()->id;
        $slack_id = $request->input('slack_id');
        $existing_record = Rest::where('user_id', $user_id)->where('slack_id', $slack_id)->whereNull('end_time')->first();

        if (!$existing_record) {
            return redirect('/');
        }

        $existing_record->end_rest = Carbon::now();
        $existing_record->time_rest = Carbon::parse($existing_record->start_rest)->diff($existing_record->end_rest)->format('%H:%I:%S');
        $existing_record->end_time = Carbon::now();
        $existing_record->save();

        $number3 = false;

        return redirect('/');
    }
}
