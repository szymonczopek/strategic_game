<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stable extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'horseAmount',
        'horseRatio',
        'horseMax',
        'horseMaxRatio',
        'stableWorkTime',
        'buildTime',
        'buildEnd',
        'buildTimeRatio',
        'wood',
        'stone',
        'buildRatio',

    ];
}
