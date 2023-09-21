<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop',
        'area',
        'genre',
        'content',
        'image'
    ];

    //usersとのリレーション
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id', 'shop_id', 'user_shop_favorites');
    }
    //reservationsとのリレーション
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'shop_id', 'id');
    }
    //user_shop_favoritesとのリレーション
    public function favoriteShop()
    {
        return $this->belongsToMany(User::class, 'user_shop_favorites', 'user_id', 'shop_id');
    }
    //reviewsとのリレーション
    public function reviews()
    {
        return $this->hasMany(Review::class, 'shop_id', 'id');
    }

    //エリアでの検索
    public function scopeArea($query, $area)
    {
        if ($area && $area !== 'All area') {
            return $query->where('area', $area);
        }
    }
    //ジャンルでの検索
    public function scopeGenre($query, $genre)
    {
        if ($genre && $genre !== 'All genre') {
            return $query->where('genre', $genre);
        }
    }
    //キーワード検索
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where('shop', 'LIKE', '%' . $keyword . '%')->orWhere('area', 'LIKE', '%' . $keyword . '%')->orWhere('genre', 'LIKE', '%' . $keyword . '%');
        }
    }

    protected $table = 'shops';
}
