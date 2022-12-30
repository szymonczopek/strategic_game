<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cityReport extends Model
{
    use HasFactory;

    public $fillable=[
        'date',
        'content',
        'idCity'
    ];
}
