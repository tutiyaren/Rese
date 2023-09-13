<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'number'
    ];

    //usersとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    //shopsとのリレーション
    public function shop()
    {
        return $this->belongsTo(Reservation::class, 'shop_id', 'id');
    }


    protected $table = 'reservations';
}
