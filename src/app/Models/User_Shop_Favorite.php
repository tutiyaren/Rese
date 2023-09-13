<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Shop_Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id'
    ];

    //usersとのリレーション
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
    //shopsとのリレーション
    public function shop()
    {
        return $this->belongsToMany(Reservation::class, 'shop_id', 'id');
    }

    protected $table = 'user_shop_favorites';
}
