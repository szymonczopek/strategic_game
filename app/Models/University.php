<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'scientists',
        'scientistMax',
        'scientistMaxRatio',
        'buildTime',
        'buildEnd',
        'buildTimeRatio',
        'wood',
        'stone',
        'buildRatio',
        'scientistsWorkTime',

    ];
}
