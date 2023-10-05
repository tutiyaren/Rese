<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //representativesとのリレーション
    public function representative()
    {
        return $this->hasMany(Representative::class, 'representative_id', 'id');
    }

    // 管理者のロールを取得するメソッド
    public function getRole()
    {
        return 'admin';
    }

    protected $table = 'admins';
}
