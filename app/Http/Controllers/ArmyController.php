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
    public function createArmy($slug)
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

    public function displayArmy()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();

        $soldierWoodCost=200;
        $soldierGoldCost=100;

        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idBonusBuilding !== NULL)
            {
                $bonusBuilding = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuilding->idBonusBuildingName===4) {
                    $soldierWoodCost=$soldierWoodCost-'0.01'*$bonusBuilding->bonus*$soldierWoodCost;
                   $soldierGoldCost=$soldierGoldCost-'0.01'*$bonusBuilding->bonus*$soldierGoldCost;
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
                        return view('buildings.army', [
                            'cityName' => $city->cityName,
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
                            'woodCost' => $soldierWoodCost,
                            'goldCost' => $soldierGoldCost,
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
                        'link' => config('globalVariables.link.army'),
                        'buildEnd'=>$army->buildEnd-time(),
                    ]);
                }else return view('layouts.error',[
                    'cityName' => $city->cityName,
                    'gold' => $city->gold,
                    'wood' => $city->wood,
                    'stone' => $city->stone,
                    'food' => $city->food,
                    'errorInfo'=>'Brak armii.'
                ]);
            }
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();

        $soldierWoodCost=200;
        $soldierGoldCost=100;

        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idBonusBuilding !== NULL)
            {
                $bonusBuilding = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuilding->idBonusBuildingName===4) {
                    $soldierWoodCost=$soldierWoodCost-'0.01'*$bonusBuilding->bonus*$soldierWoodCost;
                    $soldierGoldCost=$soldierGoldCost-'0.01'*$bonusBuilding->bonus*$soldierGoldCost;
                }

            }
        }


        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idArmy !== NULL) {
                $army=Army::where('id',$loadPosition->idArmy)->first();
                if($request->armyAmount*$soldierGoldCost <= $city->gold && $request->armyAmount*$soldierWoodCost <= $city->wood &&
                    $request->armyAmount <= $townhall->populationFree && $request->armyAmount <= $army->armyMax-$army->armyAmount)
                {
                    $city->update(['gold'=>$city->gold-$request->armyAmount*$soldierGoldCost,
                    'wood'=>$city->wood-$request->armyAmount*$soldierWoodCost]);
                    $army->update([
                        'armyAmount'=>$army->armyAmount+$request->armyAmount
                    ]);

                    return redirect('/army');
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


}
