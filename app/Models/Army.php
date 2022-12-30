<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    use HasFactory;

    public $fillable=[
        'level',
        'armyAmount',
        'armyMax',
        'armyMaxRatio',
        'buildTime',
        'buildEnd',
        'buildTimeRatio',
        'wood',
        'stone',
        'buildRatio',
    ];
}
