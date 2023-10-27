<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\City;
use App\Models\Stable;
use App\Models\townHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GlobalTrait;

class TownHallController extends Controller
{
    use GlobalTrait;

    public function displayTownhall()
    {
        $townHallPicture = config('globalVariables.link.townHall');

        $city = $this->getCity(Auth::id());
        $loadPositions = $this->getCityPositions($city);

        $horses = NULL;
        $horsesMax = NULL;

        //sprwdzenie czy isnieje stajnia
        foreach ($loadPositions as $loadPosition){
            if($loadPosition -> idStable !== NULL)
            {
                $stable = Stable::where('id', $loadPosition->idStable)->first();
                $horses=$stable->horseAmount;
                $horsesMax=$stable->horseMax;
            }
        }

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) {

                $townHall = TownHall::where('id', $loadPosition->idTownHall) -> first();
                $this -> resourcesUpdate($townHall, $city);

                $populationMaxRatio = config('globalVariables.ratio.populationMaxRatio');
                //czas populacji
                if($townHall -> population !== $townHall -> populationMax)
                {
                    $townHall -> update(['populationRatio' => round(((int)$city -> food / (int)$townHall -> population),2)]);
                    $time = time() - $townHall -> populationTime;
                    $before = $townHall -> population;

                    if ($townHall -> population > ($townHall -> populationMax )) {
                        $townHall -> update([
                            'population' => $townHall -> populationMax,
                            'populationRatio' => 0,
                            'populationFree' => (int)$townHall -> populationMax-(int)$townHall -> populationForest - (int)$townHall -> populationStonepit - (int)$townHall -> populationAgro,
                        ]);

                    }
                    else {
                        $townHall -> update(['population' => (int)($townHall -> population + $townHall -> populationRatio * $time)]);
                        $townHall -> update(['populationFree' => (int)($townHall -> populationFree +  $townHall -> populationRatio * $time)]);
                        $after =$townHall -> population;
                        if($after > $before) $townHall -> update(['populationTime' => time()]);
                    }


                }

                if ($townHall !== NULL) {
                    return view('buildings.townHall', [
                        'cityName' => $city -> cityName,
                        'gold' => $city -> gold,
                        'wood' => $city -> wood,
                        'stone' => $city -> stone,
                        'food' => $city -> food,
                        'level' => $townHall -> level,
                        'population' => $townHall -> population,
                        'populationRatio' => $townHall -> populationRatio,
                        'populationMax' => $townHall -> populationMax,
                        'populationMaxRatio' => $populationMaxRatio,
                        'populationForest' => $townHall -> populationForest,
                        'populationStonepit' => $townHall -> populationStonepit,
                        'populationAgro' => $townHall -> populationAgro,
                        'populationFree' => $townHall -> populationFree,
                        'forestRatio' => $townHall -> forestRatio,
                        'stonepitRatio' => $townHall -> stonepitRatio,
                        'agroRatio' => $townHall -> agroRatio,
                        'buildTime' => $townHall -> buildTime,
                        'woodNeed' => $townHall -> wood,
                        'stoneNeed' => $townHall -> stone,
                        'horses' => $horses,
                        'townHallPicture' => $townHallPicture,
                    ]);
                } else return view('layouts.error', [
                    'cityName' => $city->cityName,
                    'gold' => $city->gold,
                    'wood' => $city->wood,
                    'stone' => $city->stone,
                    'food' => $city->food,
                    'messege' => 'brak budynku.'
                ]);
            }
        }
    }


    public function changeWorkersAmount(Request $request)
    {
        $city = $this -> getCity(Auth::id());
        $loadPositions = $this -> getCityPositions($city);

        $horses = NULL;
        $horsesMax = NULL;

        foreach ($loadPositions as $loadPosition){
            if($loadPosition -> idStable !== NULL)
            {
                $stable = Stable::where('id', $loadPosition->idStable) -> first();
                $horses = $stable -> horseAmount;
                $horsesMax = $stable -> horseMax;

            }
        }

        foreach ($loadPositions as $loadPosition)
        {
            if ($loadPosition -> idTownHall !== NULL)
            {
                $townHall = TownHall::where('id', $loadPosition -> idTownHall) -> first();
                if($request -> populationForest !== NULL && $request -> populationStonepit !== NULL && $request -> populationAgro !== NULL) {
                    if ((int)($request -> populationForest + $request -> populationStonepit + $request->populationAgro) <= $townHall -> population + 2 * $horses) {

                        $populationFree = $townHall -> population + 2* $horses - ($request -> populationForest + $request -> populationStonepit + $request -> populationAgro);
                        $townHall -> update([
                            'populationForest' => $request->populationForest,
                            'populationStonepit' => $request->populationStonepit,
                            'populationAgro' => $request->populationAgro,
                            'populationFree' => $populationFree,
                            'woodWorkTime' => time(),
                            'stoneWorkTime' => time(),
                            'agroWorkTime' => time(),
                            'freeWorkTime' => time(),
                        ]);
                        return redirect('/townhall');
                    } else return view('layouts.error', [
                        'cityName' => $city -> cityName,
                        'gold' => $city -> gold,
                        'wood' => $city -> wood,
                        'stone' => $city -> stone,
                        'food' => $city -> food,
                        'messege' => 'Suma pracownikow przewyzsza liczbe meiszkancow!.'
                    ]);
                }
                else dd('błąd: uzupełnij wszystkie pola wartosciami');
            }
        }
    }

}
