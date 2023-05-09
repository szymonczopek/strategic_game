<?php

namespace App\Http\Traits;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

trait GlobalTrait {

    public function getCity()
    {
        $city = City::where('idUser', Auth::id())->first();
        return $city;
    }
    public function getCityPosition($city){
        $loadPositions = BoardPosition::where('idCity',$city->id)->get();
        return $loadPositions;
    }
}
