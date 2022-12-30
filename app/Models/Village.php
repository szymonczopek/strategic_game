<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'waitingTime',
        'waitingTimeRatio',
        'revenge',
        'revengeShift',
        'wallHealth',
        'wallHealthRatio',
        'rewardWood',
        'rewardStone',
        'rewardFood',
        'rewardGold',
        'rewardRatio',
        'idCity',
    ];
}
