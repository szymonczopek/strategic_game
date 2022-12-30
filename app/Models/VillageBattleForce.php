<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageBattleForce extends Model
{
    use HasFactory;

    public $fillable=[
        'amount',
        'idBattle',
        'idVillage',

    ];
}
