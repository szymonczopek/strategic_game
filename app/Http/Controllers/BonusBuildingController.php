<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\City;
use App\Models\townHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusBuildingController extends Controller
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
    public function newWoodcutter($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 10000 && $city->stone >= 10000)
        {
            $wc=BonusBuilding::create([
                'buildEnd'=>time()+1800,
                'idBonusBuildingName'=>1
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idBonusBuilding'=>$wc->id,
                'position'=>$slug,

            ]);
            //aktualizacja zdobywania surowcow na godzine
            $loadPositions = BoardPosition::where('idCity', $city->id)->get();
            foreach ($loadPositions as $loadPosition) {
                if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();

            }
            $townhall->update(['forestRatio'=>$townhall->forestRatio+5]);

            $city->update([
                'wood'=>$city->wood-10000,
                'stone'=>$city->stone-10000,
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
    public function woodcutter()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idBonusBuilding !== NULL) {
                $bonusBuildings = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuildings->idBonusBuildingName===1) {
                    $bonusBuilding = $bonusBuildings;
                }

            }
        }
        if(isset($bonusBuildings->buildEnd) && $bonusBuildings->buildEnd-time() <= 0) $bonusBuildings->update(['buildEnd'=>NULL]);

        if ($bonusBuilding !== NULL) {
           if($bonusBuilding->buildEnd===NULL)
            {
                return view('buildings.woodcutter',
                    ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $bonusBuilding->level,
                        'bonus' => $bonusBuilding->bonus,
                        'bonusUpgrade' => $bonusBuilding->bonusUpgrade,
                        'buildTime' => $bonusBuilding->buildTime,
                        'woodNeed' => $bonusBuilding->wood,
                        'stoneNeed' => $bonusBuilding->stone,
                        'forestRatio' => $townhall->forestRatio,
                    ]);
            } else return view('layouts.building', [
               'cityName' => $city->cityName,
               'gold' => $city->gold,
               'wood' => $city->wood,
               'stone' => $city->stone,
               'food' => $city->food,
               'level' => $bonusBuilding->level,
               'name' => 'Drwal',
               'link' => config('globalVariables.link.woodcutter'),
               'buildEnd'=>$bonusBuilding->buildEnd-time(),
           ]);
                } else dd("brak budynku");
    }
    public function newStonemason($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 10000 && $city->stone >= 10000)
        {
            $wc=BonusBuilding::create([
                'buildEnd'=>time()+1800,
                'idBonusBuildingName'=>2
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idBonusBuilding'=>$wc->id,
                'position'=>$slug,

            ]);
            //aktualizacja zdobywania surowcow na godzine
            $loadPositions = BoardPosition::where('idCity', $city->id)->get();
            foreach ($loadPositions as $loadPosition) {
                if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();

            }
            $townhall->update(['stonepitRatio'=>$townhall->stonepitRatio+5]);

            $city->update([
                'wood'=>$city->wood-10000,
                'stone'=>$city->stone-10000,
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

    public function stonemason()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idBonusBuilding !== NULL) {
                $bonusBuildings = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuildings->idBonusBuildingName===2) {
                    $bonusBuilding = $bonusBuildings;
                }

            }
        }

        if(isset($bonusBuildings->buildEnd) && $bonusBuildings->buildEnd-time() <= 0) $bonusBuildings->update(['buildEnd'=>NULL]);

        if ($bonusBuilding !== NULL) {
            if($bonusBuilding->buildEnd===NULL)
            {
                return view('buildings.stonemason',
                    ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $bonusBuilding->level,
                        'bonus' => $bonusBuilding->bonus,
                        'bonusUpgrade' => $bonusBuilding->bonusUpgrade,
                        'buildTime' => $bonusBuilding->buildTime,
                        'woodNeed' => $bonusBuilding->wood,
                        'stoneNeed' => $bonusBuilding->stone,
                        'stonepitRatio' => $townhall->stonepitRatio,
                    ]);
            } else return view('layouts.building', [
                'cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'level' => $bonusBuilding->level,
                'name' => 'Kamieniarz',
                'link' => 'https://cdn.imageupload.workers.dev/SRcZmXTD_kamieniarz-wyciety.png',
                'buildEnd'=>$bonusBuilding->buildEnd-time(),
            ]);
        } else dd("brak budynku");
    }
    public function newMill($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 10000 && $city->stone >= 10000)
        {
            $wc=BonusBuilding::create([
                'buildEnd'=>time()+1800,
                'idBonusBuildingName'=>3
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idBonusBuilding'=>$wc->id,
                'position'=>$slug,

            ]);
            //aktualizacja zdobywania surowcow na godzine
            $loadPositions = BoardPosition::where('idCity', $city->id)->get();
            foreach ($loadPositions as $loadPosition) {
                if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();

            }
            $townhall->update(['agroRatio'=>$townhall->agroRatio+5]);

            $city->update([
                'wood'=>$city->wood-10000,
                'stone'=>$city->stone-10000,
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
    public function mill()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idBonusBuilding !== NULL) {
                $bonusBuildings = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuildings->idBonusBuildingName===3) {
                    $bonusBuilding = $bonusBuildings;
                }

            }
        }

        if(isset($bonusBuildings->buildEnd) && $bonusBuildings->buildEnd-time() <= 0) $bonusBuildings->update(['buildEnd'=>NULL]);

        if ($bonusBuilding !== NULL) {
            if($bonusBuilding->buildEnd===NULL)
            {
                return view('buildings.mill',
                    ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $bonusBuilding->level,
                        'bonus' => $bonusBuilding->bonus,
                        'bonusUpgrade' => $bonusBuilding->bonusUpgrade,
                        'buildTime' => $bonusBuilding->buildTime,
                        'woodNeed' => $bonusBuilding->wood,
                        'stoneNeed' => $bonusBuilding->stone,
                        'agroRatio' => $townhall->agroRatio,
                    ]);
            } else return view('layouts.building', [
                'cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'level' => $bonusBuilding->level,
                'name' => 'Młyn',
                'link' => 'https://cdn.imageupload.workers.dev/4B09lXwY_mlyn-wyciety.png',
                'buildEnd'=>$bonusBuilding->buildEnd-time(),
            ]);
        } else dd("brak budynku");
    }
    public function newEngineer($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 10000 && $city->stone >= 10000)
        {
            $wc=BonusBuilding::create([
                'buildEnd'=>time()+1800,
                'idBonusBuildingName'=>4
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idBonusBuilding'=>$wc->id,
                'position'=>$slug,

            ]);

            $city->update([
                'wood'=>$city->wood-10000,
                'stone'=>$city->stone-10000,
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
    public function engineer()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idBonusBuilding !== NULL) {
                $bonusBuildings = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuildings->idBonusBuildingName===4) {
                    $bonusBuilding = $bonusBuildings;
                }

            }
        }

        if(isset($bonusBuildings->buildEnd) && $bonusBuildings->buildEnd-time() <= 0) $bonusBuildings->update(['buildEnd'=>NULL]);

        if ($bonusBuilding !== NULL) {
            if($bonusBuilding->buildEnd===NULL)
            {
                return view('buildings.engineer',
                    ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $bonusBuilding->level,
                        'bonus' => $bonusBuilding->bonus,
                        'bonusUpgrade' => $bonusBuilding->bonusUpgrade,
                        'buildTime' => $bonusBuilding->buildTime,
                        'woodNeed' => $bonusBuilding->wood,
                        'stoneNeed' => $bonusBuilding->stone,

                    ]);
            } else return view('layouts.building', [
                'cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'level' => $bonusBuilding->level,
                'name' => 'Inżynier',
                'link' => 'https://cdn.imageupload.workers.dev/YAa15agg_inzynier-wyciety.png',
                'buildEnd'=>$bonusBuilding->buildEnd-time(),
            ]);
        } else dd("brak budynku");
    }
    public function newArchitect($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 10000 && $city->stone >= 10000)
        {
            $wc=BonusBuilding::create([
                'buildEnd'=>time()+1800,
                'idBonusBuildingName'=>5
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idBonusBuilding'=>$wc->id,
                'position'=>$slug,

            ]);

            $city->update([
                'wood'=>$city->wood-10000,
                'stone'=>$city->stone-10000,
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
    public function architect()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idBonusBuilding !== NULL) {
                $bonusBuildings = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                if($bonusBuildings->idBonusBuildingName===5) {
                    $bonusBuilding = $bonusBuildings;
                }

            }
        }

        if(isset($bonusBuildings->buildEnd) && $bonusBuildings->buildEnd-time() <= 0) $bonusBuildings->update(['buildEnd'=>NULL]);

        if ($bonusBuilding !== NULL) {
            if($bonusBuilding->buildEnd===NULL)
            {
                return view('buildings.architect',
                    ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $bonusBuilding->level,
                        'bonus' => $bonusBuilding->bonus,
                        'bonusUpgrade' => $bonusBuilding->bonusUpgrade,
                        'buildTime' => $bonusBuilding->buildTime,
                        'woodNeed' => $bonusBuilding->wood,
                        'stoneNeed' => $bonusBuilding->stone,

                    ]);
            } else return view('layouts.building', [
                'cityName' => $city->cityName,
                'gold' => $city->gold,
                'wood' => $city->wood,
                'stone' => $city->stone,
                'food' => $city->food,
                'level' => $bonusBuilding->level,
                'name' => 'Architekt',
                'link' => 'https://cdn.imageupload.workers.dev/679UkLQV_architekt-wyciety.png',
                'buildEnd'=>$bonusBuilding->buildEnd-time(),
            ]);
        } else dd("brak budynku");
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
     * @param  \App\Models\BonusBuilding  $bonusBuilding
     * @return \Illuminate\Http\Response
     */
    public function show(BonusBuilding $bonusBuilding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonusBuilding  $bonusBuilding
     * @return \Illuminate\Http\Response
     */
    public function edit(BonusBuilding $bonusBuilding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonusBuilding  $bonusBuilding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonusBuilding $bonusBuilding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonusBuilding  $bonusBuilding
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonusBuilding $bonusBuilding)
    {
        //
    }
}
