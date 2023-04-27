<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slack extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'users_id',
        'date',
        'start_time',
        'end_time',
        'break_time',
        'working'
    ];

    public function users(){
        return $this->belongsToMany(Users::class);
    }
    protected $table = 'slack';
}
