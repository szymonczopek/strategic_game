<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class townHall extends Model
{
    use HasFactory;
    protected $fillable = [
        'level',
        'population',
        'populationRatio',
        'populationMax',
        'populationMaxRatio',
        'populationTime',
        'freeWorkTime',
        'woodWorkTime',
        'stoneWorkTime',
        'agroWorkTime',
        'populationForest',
        'populationStonepit',
        'populationAgro',
        'populationFree',
        'stonepitRatio',
        'agroRatio',
        'forestRatio',
        'buildTime',
        'buildTimeRatio',
        'buildEnd',
        'wood',
        'stone',
        'buildRatio',
    ];

}

