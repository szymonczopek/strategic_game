<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wall extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'health',
        'healthRatio',
        'buildTime',
        'buildEnd',
        'buildTimeRatio',
        'wood',
        'stone',
        'buildRatio',
    ];
}
