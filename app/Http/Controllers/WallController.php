<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Wall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function show(Wall $wall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function edit(Wall $wall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wall $wall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wall $wall)
    {
        //
    }
}
