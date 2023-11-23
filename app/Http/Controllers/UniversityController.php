<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\townHall;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UniversityController extends Controller
{
    /**
     * Building view
     *
     * @return View
     */
    public function newUniversity($slug)
    {
        $city = City::where('idUser', Auth::id())->first();
        if($city->wood >= 3000 && $city->stone >= 3000)
        {
            $un=University::create([
                'buildEnd'=>time()+1800,
                'scientistsWorkTime'=>time()+1800
            ]);

            BoardPosition::create([
                'idCity'=>$city->id,
                'idUniversity'=>$un->id,
                'position'=>$slug,

            ]);

            $city->update([
                'wood'=>$city->wood-3000,
                'stone'=>$city->stone-3000,
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
        $universityPicture = config('globalVariables.link.university');
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();


        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idUniversity !== NULL) {
                $university=University::where('id',$loadPosition->idUniversity)->first();

                //czas punkty technologii
                $time=time()-$university->scientistsWorkTime;
                $before=$city->technologyPoints;
                $scienceRatio=10*$university->scientists;
                $city->update(['technologyPoints' =>$city->technologyPoints+($scienceRatio*$time) ]);
                $after=$city->technologyPoints;

                if($after>$before) $university->update(['scientistsWorkTime'=>time()]);

                if(isset($university->buildEnd) && $university->buildEnd-time() <= 0) $university->update(['buildEnd'=>NULL]);

                if ($university !== NULL) {
                    if($university->buildEnd===NULL) {
                        return view('buildings.university', ['cityName' => $city->cityName,
                            'gold' => $city->gold,
                            'wood' => $city->wood,
                            'stone' => $city->stone,
                            'food' => $city->food,
                            'level' => $university->level,
                            'technologyPoints' => $city->technologyPoints,
                            'scientists' => $university->scientists,
                            'scientistsMax' => $university->scientistsMax,
                            'scientistsMaxRatio' => $university->scientistsMaxRatio,
                            'buildTime' => $university->buildTime,
                            'woodNeed' => $university->wood,
                            'stoneNeed' => $university->stone,
                            'populationFree' => $townhall->populationFree,
                            'scienceRatio' => $scienceRatio,
                            'universityPicture' => $universityPicture
                        ]);
                    }else return view('layouts.building', [
                        'cityName' => $city->cityName,
                        'gold' => $city->gold,
                        'wood' => $city->wood,
                        'stone' => $city->stone,
                        'food' => $city->food,
                        'level' => $university->level,
                        'name' => 'Akademia',
                        'link' => 'https://cdn.imageupload.workers.dev/zQYXD47F_akademia-wyciety.png',
                        'buildEnd'=>$university->buildEnd-time(),
                    ]);
                } else dd("brak akademi");
            }
        }
    }
    /**
     * Building view
     *
     * @return View
     */
    public function store(Request $request)
    {
        $city = City::where('idUser', Auth::id())->first();
        $loadPositions = BoardPosition::where('idCity', $city->id)->get();



        foreach ($loadPositions as $loadPosition) {

            if ($loadPosition->idTownHall !== NULL) $townhall = TownHall::where('id', $loadPosition->idTownHall)->first();
            if ($loadPosition->idUniversity !== NULL) {
                $university=University::where('id',$loadPosition->idUniversity)->first();
                if($request->scientists*100 < $city->gold && $request->scientists <= $townhall->populationFree && $request->scientists <= ($university->scientistsMax-$university->scientists))
                {
                    $city->update(['gold'=>$city->gold-$request->scientists*100]);
                   $university->update([
                        'scientistsWorkTime'=>time(),
                        'scientists'=>$university->scientists+ $request->scientists,
                    ]);

                    return redirect('/university');
                }
                else dd('błąd: za malo pieniedzy lub wolnych ludzi');
            }
        }
    }

}
