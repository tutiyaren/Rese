<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'slack_id',
        'start_rest',
        'end_rest',
        'time_rest',
        'end_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function slack()
    {
        return $this->belongsTo(Slack::class);
    }

    public function getTimeRestAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['time_rest'])->format('H:i:s');
    }

    protected $table = 'rests';
}
