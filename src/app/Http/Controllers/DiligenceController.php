<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slack;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class DiligenceController extends Controller
{
    public function diligence(Request $request)
    {
        $firstId = Slack::orderBy('id')->value('id');
        $perPage = 5;
        $currentUserId = $request->input('user_id', $firstId);
        $user = User::find($currentUserId);
        $userSlacks = Slack::leftJoin('users', function ($join) use ($currentUserId) {
            $join->on('slacks.user_id', '=', 'users.id')
            ->orWhereNull('users.id');
        })
        ->select('slacks.*', 'users.name as user_name')
        ->where('users.id', $currentUserId)
        ->orderBy('slacks.date', 'desc')
        ->paginate($perPage);

        $currentUser = $userSlacks->first();
        $previousUser = Slack::where('user_id', '<', $currentUserId)
        ->orderBy('user_id', 'desc')
        ->orderBy('date', 'desc')
        ->first();
        $nextUser = Slack::where('user_id', '>', $currentUserId)
        ->orderBy('user_id', 'asc')
        ->orderBy('date', 'asc')
        ->first();

        $firstUser = User::orderBy('id')->first();
        $lastUser = User::orderBy('id', 'desc')->first();

        foreach ($userSlacks as $slack) {
            $totalRestTime = 0; // 追加: $totalRestTime を初期化
            foreach ($slack->rests as $rest) {
                $totalRestTime += $this->timeToSeconds($rest->time_rest);
            }

            $workTime = $this->timeToSeconds($slack->time_work) - $totalRestTime;

            $slack->formattedRestTime = $this->formatTime($totalRestTime);
            $slack->formattedWorkTime = $this->formatTime($workTime);

            $user = User::find($slack->user_id);
            if ($user) {
                $slack->user_name = $user->name;
            }
            // 同日の同従業員の休憩をまとめて表示
            $slack->totalRestTime = $slack->totalRestTime();
        }

        return view('diligence', compact('userSlacks', 'previousUser', 'nextUser', 'currentUser','user', 'firstUser', 'lastUser', 'currentUserId'));
    }

    private function timeToSeconds($time)
    {
        $timeParts = explode(':', $time);
        $hours = isset($timeParts[0]) ? intval($timeParts[0]) : 0;
        $minutes = isset($timeParts[1]) ? intval($timeParts[1]) : 0;
        $seconds = isset($timeParts[2]) ? intval($timeParts[2]) : 0;

        return $hours * 3600 + $minutes * 60 + $seconds;
    }
    private function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }
}
