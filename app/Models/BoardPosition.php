<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'idCity',
        'idStore',
        'idWall',
        'idStable',
        'idTownHall',
        'idArmy',
        'idUniversity',
        'idBonusBuilding',

    ];
}
