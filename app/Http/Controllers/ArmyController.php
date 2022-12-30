<?php

namespace App\Http\Controllers;

use App\Models\Army;
use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\City;
use App\Models\townHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArmyController extends Controller
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
    public function newArmy($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 2000 && $city->stone >= 2000)
        {
            $stable=Army::create([
                'buildEnd'=>time()+1800,

            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idArmy'=>$stable->id,
                'position'=>$slug,

            ]);

            $city->update([
                'wood'=>$city->wood-2000,
                'stone'=>$city->stone-2000,
            ]);


            return redirect('/');
        }
        else return view('layouts.error',[
            'cityName' => $city->cityName,
            'gold' => $city->gold,
            'wood' => $city->wood,
            'stone' => $city->stone,
            'food' => $city->food,
            'errorInfo'=>'Brak wymaganych surowców.'
        ]);
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

        $woodCost=200;
        $goldCost=100;

        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idBonusBuilding !== NULL)
            {
                $bonusBuilding = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuilding->idBonusBuildingName===4) {
                    $woodCost=$woodCost-'0.01'*$bonusBuilding->bonus*$woodCost;
                   $goldCost=$goldCost-'0.01'*$bonusBuilding->bonus*$goldCost;
                }

            }
        }

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idArmy !== NULL) {
                $army=Army::where('id',$loadPosition->idArmy)->first();

                if(isset($army->buildEnd) && $army->buildEnd-time() <= 0) $army->update(['buildEnd'=>NULL]);

                if ($army !== NULL) {
                    if($army->buildEnd===NULL) {
                        return view('buildings.army', ['cityName' => $city->cityName,
                            'gold' => $city->gold,
                            'wood' => $city->wood,
                            'stone' => $city->stone,
                            'food' => $city->food,
                            'level' => $army->level,
                            'armyAmount' => $army->armyAmount,
                            'armyMax' => $army->armyMax,
                            'armyMaxRatio' => $army->armyMaxRatio,
                            'buildTime' => $army->buildTime,
                            'woodNeed' => $army->wood,
                            'stoneNeed' => $army->stone,
                            'woodCost' => $woodCost,
                            'goldCost' => $goldCost,
                            'populationFree' => $townhall->populationFree
                        ]);
                    }else return view('layouts.building', [
                        'cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $army->level,
                        'name' => 'Koszary',
                        'link' => 'https://cdn.imageupload.workers.dev/qoOhiYyN_koszary-wyciete.png',
                        'buildEnd'=>$army->buildEnd-time(),
                    ]);
                } else dd("brak armi");
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
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();

        $woodCost=200;
        $goldCost=100;

        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idBonusBuilding !== NULL)
            {
                $bonusBuilding = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuilding->idBonusBuildingName===4) {
                    $woodCost=$woodCost-'0.01'*$bonusBuilding->bonus*$woodCost;
                    $goldCost=$goldCost-'0.01'*$bonusBuilding->bonus*$goldCost;
                }

            }
        }


        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idArmy !== NULL) {
                $army=Army::where('id',$loadPosition->idArmy)->first();
                if($request->armyAmount*$goldCost <= $city->gold && $request->armyAmount*$woodCost <= $city->wood &&
                    $request->armyAmount <= $townhall->populationFree && $request->armyAmount <= $army->armyMax-$army->armyAmount)
                {
                    $city->update(['gold'=>$city->gold-$request->armyAmount*$goldCost,
                    'wood'=>$city->wood-$request->armyAmount*$woodCost]);
                    $army->update([
                        'armyAmount'=>$army->armyAmount+$request->armyAmount
                    ]);

                    return redirect('/KOSZARY');
                }
                else return view('layouts.error',[
                    'cityName' => $city->cityName,
                    'gold' => $city->gold,
                    'wood' => $city->wood,
                    'stone' => $city->stone,
                    'food' => $city->food,
                    'errorInfo'=>'Brak wymaganych surowców lub niedostateczna ilość wolnej populacji.'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Army  $army
     * @return \Illuminate\Http\Response
     */
    public function show(Army $army)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Army  $army
     * @return \Illuminate\Http\Response
     */
    public function edit(Army $army)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Army  $army
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Army $army)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Army  $army
     * @return \Illuminate\Http\Response
     */
    public function destroy(Army $army)
    {
        //
    }
}
