<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function newStore($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 2000 && $city->stone >= 2000)
        {
            $st=Store::create( ['buildEnd'=>time()+1800]);

            BoardPosition::create([
               'idCity'=>$city->id,
                'idStore'=>$st->id,
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



        foreach ($loadPositions as $loadPosition) {
            if ($loadPosition->idStore !== NULL) {
                $store = Store::where('id', $loadPosition->idStore)->first();

                if(isset($store->buildEnd) && $store->buildEnd-time() <= 0) $store->update(['buildEnd'=>NULL]);


                if ($store !== NULL) {
                    if($store->buildEnd===NULL) {
                        return view('buildings.store',
                            ['cityName' => $city->cityName,
                                'gold' => $city->gold,
                                'wood' => $city->wood,
                                'stone' => $city->stone,
                                'food' => $city->food,
                                'level' => $store->level,
                                'protectedStock' => $store->protectedStock,
                                'protectedStockRatio' => $store->protectedStockRatio,
                                'buildTime' => $store->buildTime,
                                'woodNeed' => $store->wood,
                                'stoneNeed' => $store->stone,
                            ]);//na dole widok budowy
                    }  else return view('layouts.building', [
                        'cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $store->level,
                        'name' => 'Magazyn',
                        'link' => 'https://cdn.imageupload.workers.dev/OLuYK2Ru_magazyn-wyciety.png',
                        'buildEnd'=>$store->buildEnd-time(),
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
