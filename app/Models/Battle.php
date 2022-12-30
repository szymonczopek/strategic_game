<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    public $fillable=[
        'startingBattle',
        'wonBattle',
        'time',
        'rewardWood',
        'rewardStone',
        'rewardFood',
        'rewardGold',
    ];
}
