<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Stable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GlobalTrait;
use Illuminate\View\View;

class StableController extends Controller
{
    use GlobalTrait;
    /**
     * Building view
     *
     * @return View
     */
    public function newStable($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 5000 && $city->stone >= 5000)
        {
            $stable=Stable::create([
                'buildEnd' => time()+1800,
                'stableWorkTime' => time()+1800,

            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idStable'=>$stable->id,
                'position'=>$slug,

            ]);

            $city->update([
                'wood'=>$city->wood-5000,
                'stone'=>$city->stone-5000,
            ]);


            return redirect('/');
        }
        else return view('layouts.error',[
            'cityName' => $city->cityName,
            'gold' => $city->gold,
            'wood' => $city->wood,
            'stone' => $city->stone,
            'food' => $city->food,
            'messege'=>'Brak wymaganych surowców.'
        ]);
    }

    /**
     * Building view
     *
     * @return View
     */
    public function displayStable()
    {
        $city = $this->getCity(Auth::id());
        $loadPositions = $this->getCityPositions($city);

        $stablePicture = config('globalVariables.link.stable');

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idStable !== NULL) {
                $stable = Stable::where('id', $loadPosition->idStable)->first();

//czas przyrostu koni
                if($stable->buildEnd === NULL && $stable->horseAmount!==$stable->horseMax)
                {
                    $stable->update(['horseRatio'=>round(((int)$city->food/(int)$stable->horseAmount/10),2)]);
                    $time = time() - $stable->stableWorkTime;
                    $before= $stable->horseAmount;

                    if ($stable->horseAmount > $stable->horseMax) {
                        $stable->update([
                            'horseAmount' => $stable->horseMax,
                            'horseRatio' => 0,
                        ]);

                    }
                    else {
                        $stable->update(['horseAmount' => (int)($stable->horseAmount +  $stable->horseRatio * $time)]);

                        $after=$stable->horseAmount;
                        if($after>$before) $stable->update(['stableWorkTime' => time()]);
                    }


                }

               // $this->endBuild($stable);
                if(isset($stable->buildEnd) && $stable->buildEnd-time() <= 0) {
                    $stable->update(['buildEnd' => NULL]);
                    $stable->update(['stableWorkTime' => time()]);

                }


                if ($stable !== NULL) {
                    if($stable->buildEnd===NULL) {
                        return view('buildings.stable',
                            ['cityName' => $city->cityName,
                                'gold' => $city->gold,
                                'wood' => $city->wood,
                                'stone' => $city->stone,
                                'food' => $city->food,
                                'level' => $stable->level,
                                'horseAmount' => $stable->horseAmount,
                                'horseRatio' => $stable->horseRatio,
                                'horseMax' => $stable->horseMax,
                                'horseMaxRatio' => $stable->horseMaxRatio,
                                'buildTime' => $stable->buildTime,
                                'woodNeed' => $stable->wood,
                                'stoneNeed' => $stable->stone,
                                'stablePicture' => $stablePicture,
                            ]);
                    } else return view('layouts.building', [
                        'cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $stable->level,
                        'name' => 'Stajnia',
                        'link' => $stablePicture,
                        'buildEnd'=>$stable->buildEnd-time(),
                    ]);
                }else dd("brak budynku");
            }
        }
    }

}
