<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusBuilding extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'bonus',
        'bonusUpgrade',
        'buildTime',
        'buildEnd',
        'buildTimeRatio',
        'wood',
        'stone',
        'buildRatio',
        'idBonusBuildingName',

    ];
}
