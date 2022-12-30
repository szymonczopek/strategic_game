<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $fillable = [
        'cityName',
        'gold',
        'wood',
        'stone',
        'food',
        'technologyPoints',
        'idUser',
    ];
}
