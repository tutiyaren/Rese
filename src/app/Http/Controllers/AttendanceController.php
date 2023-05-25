<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slack;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;
use Carbon\CarbonInterval;


class AttendanceController extends Controller
{
    //日付一覧
    public function data(Request $request)
    {
        $latestDate =
        Slack::latest('date')->value('date');

        $date = $request->input('date', $latestDate); // リクエストからdateパラメータを取得
        
        $prevSlack = Slack::where('date', '<', $date)
        ->orderBy('date', 'desc')
        ->first();
        $nextSlack = Slack::where('date', '>', $date)
        ->orderBy('date', 'asc')
        ->first();

        $query = Slack::query();
        if ($date) {
            $query->where('date', $date);
        }
        $perPage = 5;
        $slacks = $query->with(['users', 'rests'])
            ->orderBy('date', 'desc')
            ->groupBy('date', 'id')
            ->paginate($perPage);

        

        foreach($slacks as $slack){
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
        
        return view('attendance', compact('slacks','date', 'prevSlack', 'nextSlack'));
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
