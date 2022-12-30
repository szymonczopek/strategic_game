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


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $city = City::where('idUser', Auth::id())->first();

        $loadPositions=BoardPosition::where('idCity',$city->id)->get();

        for($i=1;$i<=8;$i++){
            $posLink[$i]=NULL;
            $posName[$i]=NULL;
        }

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) {
                $th = TownHall::where('id', $loadPosition->idTownHall)->first();


                //czas wolnych
                    $time=time()-$th->freeWorkTime;
                    $before=$city->gold;
                    $city->update(['gold' =>$city->gold + (int)(1/360*$time*$th->populationFree)]);
                    $after=$city->gold;

                    if($after>$before) $th->update(['freeWorkTime'=>time()]);

                    //czas drewna
                    $time=time()-$th->woodWorkTime;
                    $before=$city->wood;
                    $city->update(['wood' => (int)($city->wood + 1/360*$time*$th->populationForest*$th->forestRatio)]);
                    $after=$city->wood;

                    if($after>$before) $th->update(['woodWorkTime'=>time()]);

                    //czas kamien
                    $time=time()-$th->stoneWorkTime;
                    $before=$city->stone;
                    $city->update(['stone' => (int)($city->stone + 1/360*$time*$th->populationStonepit*$th->stonepitRatio)]);
                    $after=$city->stone;

                    if($after>$before) $th->update(['stoneWorkTime'=>time()]);

                    //czas jedzenie
                    $time=time()-$th->agroWorkTime;
                    $before=$city->food;
                    $city->update(['food' => (int)($city->food + 1/360*$time*$th->populationAgro*$th->agroRatio)]);
                    $after=$city->food;

                    if($after>$before) $th->update(['agroWorkTime'=>time()]);
            }
                    foreach ($loadPositions as $loadPosition) {

                        if ($loadPosition->idStore !== NULL) {
                            $posName[$loadPosition->position] = 'MAGAZYN';
                            $st=Store::where('id',$loadPosition->idStore)->first();
                            if($st->buildEnd===NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/OLuYK2Ru_magazyn-wyciety.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                        }
                        if ($loadPosition->idWall !== NULL) {
                            $posName[$loadPosition->position]='MUR';
                            $wall=Wall::where('id',$loadPosition->idWall)->first();
                            if($wall->buildEnd===NULL) $posLink[$loadPosition->position] ='https://cdn.imageupload.workers.dev/yDOyZuJK_mur-wyciety.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';

                        }
                        if ($loadPosition->idStable !== NULL) {
                            $posName[$loadPosition->position]='STAJNIA';
                            $stable=Stable::where('id',$loadPosition->idStable)->first();
                            if($stable->buildEnd===NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/n3fNlnYs_stajnia-wyciete.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                        }
                        if ($loadPosition->idTownHall !== NULL) {
                            $posName[$loadPosition->position]='RATUSZ';
                            $townhall=townHall::where('id',$loadPosition->idTownHall)->first();
                            if($townhall->buildEnd===NULL) $posLink[$loadPosition->position] ='https://cdn.imageupload.workers.dev/KPzEFRwr_ratusz_wyciety.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                        }
                        if ($loadPosition->idArmy !== NULL) {
                            $posName[$loadPosition->position]='KOSZARY';
                            $army=Army::where('id',$loadPosition->idArmy)->first();
                            if($army->buildEnd===NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/qoOhiYyN_koszary-wyciete.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                        }
                        if ($loadPosition->idUniversity !== NULL) {
                            $posName[$loadPosition->position]='AKADEMIA';
                            $un=University::where('id',$loadPosition->idUniversity)->first();
                            if($un->buildEnd===NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/NLODs3Cr_akademia-wyciety.png';
                            else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                        }
                        if ($loadPosition->idBonusBuilding !== NULL) {

                            $build= BonusBuilding::where('id',$loadPosition->idBonusBuilding)->first();
                            $buildsNames= BonusBuildingName::where('id',$build->idBonusBuildingName)->first();

                            $posName[$loadPosition->position]=$buildsNames->name;

                            if($buildsNames->name==='DRWAL')
                            {
                                if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/rZxt18DW_drwal-wyciety.png';
                                else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                            }

                            if($buildsNames->name==='KAMIENIARZ') {
                                if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/9R9QV8Jt_kamieniarz-wyciety.png';
                                else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                            }
                            if($buildsNames->name==='MŁYN') {
                                if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/4B09lXwY_mlyn-wyciety.png';
                                else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                            }
                            if($buildsNames->name==='INŻYNIER') {
                                if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/QqW21kGL_inzynier-wyciety.png';
                                else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
                            }
                            if($buildsNames->name==='ARCHITEKT') {
                                if ($build->buildEnd === NULL) $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/T4VVZknd_architekt-wyciety.png';
                                else $posLink[$loadPosition->position] = 'https://cdn.imageupload.workers.dev/D5o8I23m_budowa-wyciety.png';
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
                'sends'=>[
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate(
            [
                'cityName' => 'required|alpha|max:16'
            ]
        );

        $city = City::create([
            'cityName' => $request->cityName,
            'idUser' => Auth::id(),

        ]);

        $townhall = TownHall::create([
            'populationTime'=>time(),
            'woodWorkTime'=>time(),
            'stoneWorkTime'=>time(),
            'agroWorkTime'=>time(),
            'freeWorkTime'=>time(),

        ]);

        BoardPosition::create([
            'position' => 1,
            'idCity' => $city->id,
            'idTownHall' => $townhall->id
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
