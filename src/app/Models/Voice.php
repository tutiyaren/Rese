<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['rating'];

    protected $fillable = [
        'user_id',
        'shop_id',
        'rating',
        'comment',
        'image'
    ];

    //usersとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    //shopsとのリレーション
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function ratingComment()
    {
        switch ($this->rating) {
            case 5:
                return '大変満足です';
            case 4:
                return '満足です';
            case 3:
                return '普通です';
            case 2:
                return '不満です';
            case 1:
                return '大変不満です';
            default:
                return '';
        }
    }

    public function userReviews($shopId)
    {
        return $this->where('shop_id', $shopId)->where('user_id', '!=', auth()->id())->get();
    }

    public function userVoices($shopId)
    {
        return Voice::where('shop_id', $shopId)
            ->where('user_id', '!=', auth()->id());
    }

    protected $table = 'voices';

}
