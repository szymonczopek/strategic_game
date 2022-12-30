<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ownedTechnology extends Model
{
    use HasFactory;

    public $fillable=[
        'idTechnology',
        'idCity'
    ];
}
