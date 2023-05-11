<?php

namespace App\Http\Controllers;

use App\Models\Army;
use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\BonusBuildingName;
use App\Models\City;
use App\Models\Store;
use App\Models\Stable;
use App\Models\Wall;
use App\Models\townHall;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GlobalTrait;

class CityController extends Controller
{
    use GlobalTrait;

    public function displayBoard()
    {
        $user = Auth::id();
        $city = $this -> getCity($user);

        $loadPositions = $this->getCityPositions($city);

        for($i = 1;$i <= 8;$i++){
            $posLink[$i] = NULL;
            $posName[$i] = NULL;
        }

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition -> idTownHall !== NULL) {
                $this->resourcesUpdate($loadPosition -> idTownHall, $city);
            }
                    foreach ($loadPositions as $loadPosition) {

                        if ($loadPosition->idStore !== NULL) {
                            $posName[$loadPosition->position] = 'MAGAZYN';
                            $store=Store::where('id',$loadPosition->idStore) -> first();
                            if($store->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.store');
                            else $posLink[$loadPosition->position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition->idWall !== NULL) {
                            $posName[$loadPosition->position] = 'MUR';
                            $wall=Wall::where('id',$loadPosition->idWall) -> first();
                            if($wall -> buildEnd === NULL) $posLink[$loadPosition -> position] = config('globalVariables.link.wall');
                            else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition->idStable !== NULL) {
                            $posName[$loadPosition->position]='STAJNIA';
                            $stable = Stable::where('id',$loadPosition->idStable)->first();
                            if($stable -> buildEnd === NULL) $posLink[$loadPosition -> position] = config('globalVariables.link.stable');
                            else $posLink[$loadPosition->position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition->idTownHall !== NULL) {
                            $posName[$loadPosition -> position] = 'RATUSZ';
                            $townhall = townHall::where('id',$loadPosition -> idTownHall)->first();
                            if($townhall -> buildEnd === NULL) $posLink[$loadPosition -> position] = config('globalVariables.link.townHall');
                            else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition->idArmy !== NULL) {
                            $posName[$loadPosition->position] = 'KOSZARY';
                            $army = Army::where('id',$loadPosition->idArmy) -> first();
                            if($army -> buildEnd === NULL) $posLink[$loadPosition -> position] = config('globalVariables.link.army');
                            else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition->idUniversity !== NULL) {
                            $posName[$loadPosition -> position] = 'AKADEMIA';
                            $un = University::where('id',$loadPosition -> idUniversity) -> first();
                            if($un -> buildEnd===NULL) $posLink[$loadPosition -> position] = config('globalVariables.link.university');
                            else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                        }
                        if ($loadPosition -> idBonusBuilding !== NULL) {

                            $build = BonusBuilding::where('id',$loadPosition -> idBonusBuilding) -> first();
                            $buildsNames = BonusBuildingName::where('id',$build -> idBonusBuildingName) -> first();

                            $posName[$loadPosition->position] = $buildsNames->name;

                            switch ($buildsNames -> name) {
                                case 'DRWAL':
                                    {
                                        if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.woodcutter');
                                        else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                                    }break;
                                case 'KAMIENIARZ':
                                    {
                                        if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.stonemason');
                                        else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                                    }break;
                                case 'MŁYN':
                                    {
                                        if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.mill');
                                        else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                                    }break;
                                case 'INŻYNIER':
                                    {
                                        if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.engineer');
                                        else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                                    }break;
                                case 'ARCHITEKT':
                                    {
                                        if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = config('globalVariables.link.architect');
                                        else $posLink[$loadPosition -> position] = config('globalVariables.link.building');
                                    }
                            }

                        }

                    }
        }

        return view('layouts.board',
            ['cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'backgroundPicture' => config('globalVariables.link.background'),
                'flagPicture' => config('globalVariables.link.flag'),
                'buildings'=>[
                    1=>['link'=>$posLink[1],
                        'name'=>$posName[1]],
                    2=>['link'=>$posLink[2],
                        'name'=>$posName[2]],
                    3=>['link'=>$posLink[3],
                        'name'=>$posName[3]],
                    4=>['link'=>$posLink[4],
                        'name'=>$posName[4]],
                    5=>['link'=>$posLink[5],
                        'name'=>$posName[5]],
                    6=>['link'=>$posLink[6],
                        'name'=>$posName[6]],
                    7=>['link'=>$posLink[7],
                        'name'=>$posName[7]],
                    8=>['link'=>$posLink[8],
                        'name'=>$posName[8]]]
            ]);

    }

    public function createCity(Request $request)
    {
        $request->validate(
            [
                'cityName' => 'required|alpha|max:16'
            ]
        );

        $city = City::where('cityName', $request->cityName)->first();
         if($city) {
             return view('layouts.error', [
                 'messege' => 'Istnieje juz miasto o takiej naziwe!.'
             ]);
         }
         else {
                $city = City::create([
                    'cityName' => $request->cityName,
                    'gold' => 50,
                    'wood' => 50,
                    'stone' => 50,
                    'food' => 50,
                    'technologyPoints' => 0,
                    'idUser' => Auth::id(),

                ]);

                $townhall = TownHall::create([
                    'level' => 1,
                    'population' => 10,
                    'populationRatio' => 0,
                    'populationMax' => 1000,
                    'populationMaxRatio' => 1.4,
                    'populationTime' => time(),
                    'woodWorkTime' => time(),
                    'stoneWorkTime' => time(),
                    'agroWorkTime' => time(),
                    'freeWorkTime' => time(),
                    'populationForest' => 0,
                    'populationStonepit' => 0,
                    'populationAgro' => 0,
                    'populationFree' => 10,
                    'forestRatio' => 10,
                    'stonepitRatio' => 10,
                    'agroRatio' => 10,
                    'buildTime' => 3600,
                    'buildTimeRatio' => 1.2,
                    'wood' => 5000,
                    'stone' => 5000,
                    'buildRatio' => 1.6
                ]);

                BoardPosition::create([
                    'position' => 1,
                    'idCity' => $city->id,
                    'idTownHall' => $townhall->id
                ]);

                return view('layouts.error', [
                    'cityName' => $city->cityName,
                    'gold' => $city->gold,
                    'wood' => $city->wood,
                    'stone' => $city->stone,
                    'food' => $city->food,
                    'messege' => 'Utworzono miasto!.'
                ]);
            }
    }

}
