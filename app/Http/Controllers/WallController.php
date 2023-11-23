<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Wall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WallController extends Controller
{

    /**
     * Building view
     *
     * @return View
     */
    public function create()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idWall !== NULL) {
                $wall = Wall::where('id', $loadPosition->idWall)->first();


                if ($wall !== NULL) {
                    return view('buildings.wall',
                        ['cityName' => $city->cityName,
                            'gold' => $city->gold,
                            'wood' => $city->wood,
                            'stone' => $city->stone,
                            'food' => $city->food,
                            'level' => $wall->level,
                            'health'=>$wall->health,
                            'healthRatio'=>$wall->healthRatio,
                            'buildTime' => $wall->buildTime,
                            'woodNeed' => $wall->wood,
                            'stoneNeed' => $wall->stone,
                        ]);
                } else dd("brak budynku");
            }
        }
    }

}
