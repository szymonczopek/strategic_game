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
use Illuminate\View\View;

class CityController extends Controller
{
    use GlobalTrait;

    /**
     * Building view
     *
     * @return View
     */
    public function displayBoard()
    {
        $user = Auth::id();
        $city = $this -> getCity($user);

        $loadPositions = $this->getCityPositions($city);

        for($i = 1;$i <= 8;$i++){
            $posPicture[$i] = NULL;
            $posName[$i] = NULL;
            $posLink[$i] = NULL;
        }

        $duringBuilding = config('globalVariables.link.building');

        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition -> idTownHall !== NULL) {
                $townHall = townHall::where('id', $loadPosition -> idTownHall) -> first();
                $this->resourcesUpdate($townHall, $city);

                $posName[$loadPosition -> position] = 'RATUSZ';
                $posLink[$loadPosition -> position] = '/townhall';
                if($townHall -> buildEnd === NULL) $posPicture[$loadPosition -> position] = config('globalVariables.link.townHall');
                else $posPicture[$loadPosition -> position] = $duringBuilding;
            }
            if ($loadPosition->idStore !== NULL) {
                $posName[$loadPosition->position] = 'MAGAZYN';
                $posLink[$loadPosition -> position] = '/store';
                $store=Store::where('id',$loadPosition->idStore) -> first();
                if($store->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.store');
                else $posPicture[$loadPosition->position] = $duringBuilding;
            }
            if ($loadPosition->idWall !== NULL) {
                $posName[$loadPosition->position] = 'MUR';
                $posLink[$loadPosition -> position] = '/wall';
                $wall=Wall::where('id',$loadPosition->idWall) -> first();
                if($wall -> buildEnd === NULL) $posPicture[$loadPosition -> position] = config('globalVariables.link.wall');
                else $posPicture[$loadPosition -> position] = $duringBuilding;
            }
            if ($loadPosition->idStable !== NULL) {
                $posName[$loadPosition->position]='STAJNIA';
                $posLink[$loadPosition -> position]='/stable';
                $stable = Stable::where('id',$loadPosition->idStable)->first();
                if($stable -> buildEnd === NULL) $posPicture[$loadPosition -> position] = config('globalVariables.link.stable');
                else $posPicture[$loadPosition->position] = $duringBuilding;
            }
            if ($loadPosition->idArmy !== NULL) {
                $posName[$loadPosition->position] = 'KOSZARY';
                $posLink[$loadPosition -> position] = '/army';
                $army = Army::where('id',$loadPosition->idArmy) -> first();
                if($army -> buildEnd === NULL) $posPicture[$loadPosition -> position] = config('globalVariables.link.army');
                else $posPicture[$loadPosition -> position] = $duringBuilding;
            }
            if ($loadPosition->idUniversity !== NULL) {
                $posName[$loadPosition -> position] = 'AKADEMIA';
                $posLink[$loadPosition -> position] = '/university';
                $un = University::where('id',$loadPosition -> idUniversity) -> first();
                if($un -> buildEnd===NULL) $posPicture[$loadPosition -> position] = config('globalVariables.link.university');
                else $posPicture[$loadPosition -> position] = $duringBuilding;
            }
            if ($loadPosition -> idBonusBuilding !== NULL) {
                $build = BonusBuilding::where('id',$loadPosition -> idBonusBuilding) -> first();
                $buildsNames = BonusBuildingName::where('id',$build -> idBonusBuildingName) -> first();

                $posName[$loadPosition->position] = $buildsNames->name;

                switch ($buildsNames -> name) {
                    case 'DRWAL':
                        {
                            $posLink[$loadPosition -> position] = '/woodcutter';
                            if ($build->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.woodcutter');
                            else {
                                $posPicture[$loadPosition->position] = $duringBuilding;
                            }
                        }break;
                    case 'KAMIENIARZ':
                        {
                            $posLink[$loadPosition -> position] = '/stonemason';
                            if ($build->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.stonemason');
                            else {
                                $posPicture[$loadPosition->position] = $duringBuilding;

                            }
                        }break;
                    case 'MŁYN':
                        {
                            $posLink[$loadPosition -> position] = '/mill';
                            if ($build->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.mill');
                            else {
                                $posPicture[$loadPosition->position] = $duringBuilding;
                            }
                        }break;
                    case 'INŻYNIER':
                        {
                            $posLink[$loadPosition -> position] = '/engineer';
                            if ($build->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.engineer');
                            else {
                                $posPicture[$loadPosition->position] = $duringBuilding;
                            }
                        }break;
                    case 'ARCHITEKT':
                        {
                            $posLink[$loadPosition -> position] = '/architect';
                            if ($build->buildEnd === NULL) $posPicture[$loadPosition->position] = config('globalVariables.link.architect');
                            else {
                                $posPicture[$loadPosition->position] = $duringBuilding;
                            }
                        }break;
                }

            }
        }
        $buildingsData = [];
        for ($i = 1; $i <= 8; $i++) {
            $buildingsData[$i] = [
            'buildingPicture' => $posPicture[$i],
            'buildingName' => $posName[$i],
            'buildingLink' => $posLink[$i],
        ];
    }

        return view('layouts.board',
            ['cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'backgroundPicture' => config('globalVariables.link.background'),
                'flagPicture' => config('globalVariables.link.flag'),
                'buildings'=> $buildingsData
            ]);
    }
    /**
     * Building view
     *
     * @return View
     */
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
                $townHall = TownHall::create([
                    'level' => 1,
                    'population' => 10,
                    'populationRatio' => 0,
                    'populationMax' => 1000,
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
                    'wood' => 5000,
                    'stone' => 5000,

                ]);

                BoardPosition::create([
                    'position' => 1,
                    'idCity' => $city->id,
                    'idTownHall' => $townHall->id
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
    public function updatelevelTownHall(){

    }


}
