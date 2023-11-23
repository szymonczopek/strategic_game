<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * Building view
     *
     * @return View | Redirect
     */
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
            'messege'=>'Brak wymaganych surowców.'
        ]);
    }

    /**
     * Building view
     *
     * @return View
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
                        'link' => 'https://cdn.imageupload.workers.dev/LGTJOgIp_magazyn-wyciety.png',
                        'buildEnd'=>$store->buildEnd-time(),
                    ]);
                } else dd("brak budynku");
            }
        }
    }

}
