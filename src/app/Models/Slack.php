<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use Carbon\CarbonInterval;

class Slack extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'time_work',
        'work_time',
        'total_rest_time',
        'user_name'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    protected $table = 'slacks';

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

    protected $appends = ['total_rest_time', 'work_time']; // 追加

    public function getTotalRestTimeAttribute()
    {
        $totalRestTime = 0;

        foreach ($this->rests as $rest) {
            $totalRestTime += $this->timeToSeconds($rest->time_rest);
        }

        return $this->formatTime($totalRestTime);
    }

    public function getWorkTimeAttribute()
    {
        $totalRestTime = 0;

        foreach ($this->rests as $rest) {
            $totalRestTime += $this->timeToSeconds($rest->time_rest);
        }

        $workTime = $this->timeToSeconds($this->time_work) - $totalRestTime;

        return $this->formatTime($workTime);
    }

    public function totalRestTime()
    {
        $totalSeconds = 0;

        foreach ($this->rests as $rest) {
            $totalSeconds += $this->timeToSeconds($rest->time_rest);
        }

        return $this->formatTime($totalSeconds);
    }
   
}
