<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Representative extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'email',
        'password',
    ];

    //adminsとのリレーション
    public function admin()
    {
        return $this->belongsToMany(Admin::class, 'admin_id', 'id');
    }

    //shopsとのリレーション
    public function shops()
    {
        return $this->hasMany(Shop::class, 'representative_id', 'id');
    }

    // デフォルト値を設定
    protected $attributes = [
        'admin_id' => 1,
    ];

    // パスワードをハッシュ化して保存
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected $table = 'representatives';
}
