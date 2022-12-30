<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\City;
use App\Models\Stable;
use App\Models\townHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TownHallController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();

        $horses = NULL;
        $horsesMax=NULL;

        //sprwdzenie czy isnieje wstajnia
        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idStable !== NULL)
            {
                $stable = Stable::where('id', $loadPosition->idStable)->first();
                $horses=$stable->horseAmount;
                $horsesMax=$stable->horseMax;

            }
        }

        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) {

                $th = TownHall::where('id', $loadPosition->idTownHall)->first();

                //czas populacji
                if($th->population!==$th->populationMax)
                {
                    $th->update(['populationRatio'=>round(((int)$city->food/(int)$th->population),2)]);
                    $time = time() - $th->populationTime;
                    $before=$th->population;

                    if ($th->population > ($th->populationMax )) {
                        $th->update([
                            'population' => $th->populationMax,
                            'populationRatio' => 0,
                            'populationFree'=>(int)$th->populationMax-(int)$th->populationForest-(int)$th->populationStonepit-(int)$th->populationAgro,
                        ]);

                    }
                    else {
                        $th->update(['population' => (int)($th->population +  $th->populationRatio * $time)]);
                        $th->update(['populationFree' =>(int)($th->populationFree +  $th->populationRatio * $time)]);
                        $after=$th->population;
                        if($after>$before) $th->update(['populationTime' => time()]);
                    }


                }

                if ($th !== NULL) {
                    return view('buildings.townHall', ['cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $th->level,
                        'population' => $th->population,
                        'populationRatio' => $th->populationRatio,
                        'populationMax' => $th->populationMax,
                        'populationMaxRatio' => $th->populationMaxRatio,
                        'populationForest' => $th->populationForest,
                        'populationStonepit' => $th->populationStonepit,
                        'populationAgro' => $th->populationAgro,
                        'populationFree' => $th->populationFree,
                        'forestRatio' => $th->forestRatio,
                        'stonepitRatio' => $th->stonepitRatio,
                        'agroRatio' => $th->agroRatio,
                        'buildTime' => $th->buildTime,
                        'woodNeed' => $th->wood,
                        'stoneNeed' => $th->stone,
                        'horses'=>$horses
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
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();

        $horses = NULL;
        $horsesMax=NULL;


        foreach ($loadPositions as $loadPosition){
            if($loadPosition->idStable !== NULL)
            {
                $stable = Stable::where('id', $loadPosition->idStable)->first();
                $horses=$stable->horseAmount;
                $horsesMax=$stable->horseMax;

            }
        }

        foreach ($loadPositions as $loadPosition)
        {
            if ($loadPosition->idTownHall !== NULL)
            {
                $th = TownHall::where('id', $loadPosition->idTownHall)->first();
                if(isset($request->populationForest) && isset($request->populationStonepit) && isset($request->populationAgro)) {
                    if ((int)($request->populationForest + $request->populationStonepit + $request->populationAgro) <= $th->population + 2 * $horses) {

                        $pf = $th->population+2*$horses - ($request->populationForest + $request->populationStonepit + $request->populationAgro);
                        $th->update([
                            'populationForest' => $request->populationForest,
                            'populationStonepit' => $request->populationStonepit,
                            'populationAgro' => $request->populationAgro,
                            'populationFree' => $pf,
                            'woodWorkTime' => time(),
                            'stoneWorkTime' => time(),
                            'agroWorkTime' => time(),
                            'freeWorkTime' => time(),
                        ]);
                        return redirect('/RATUSZ');
                    } else dd('błąd: suma pracowników przekracza liczbe mieszkańcow');
                }
                else dd('błąd: uzupełnij wszystkie pola wartosciami');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\townHall  $townHall
     * @return \Illuminate\Http\Response
     */
    public function show(townHall $townHall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\townHall  $townHall
     * @return \Illuminate\Http\Response
     */
    public function edit(townHall $townHall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\townHall  $townHall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, townHall $townHall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\townHall  $townHall
     * @return \Illuminate\Http\Response
     */
    public function destroy(townHall $townHall)
    {
        //
    }
}
