<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_name'
    ];

    //shopsとのリレーション
    public function shop()
    {
        return $this->hasMany(Shop::class, 'user_id', 'id');
    }
    //reservationsとのリレーション
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }
    //user_shop_favoritesとのリレーション
    public function favoriteShop()
    {
        return $this->belongsToMany(Shop::class, 'user_shop_favorites', 'user_id', 'shop_id');
    }
    //reviewsとのリレーション
    public function review()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
