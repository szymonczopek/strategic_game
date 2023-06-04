<?php

namespace App\Http\Controllers;

use App\Models\BoardPosition;
use App\Models\BonusBuilding;
use App\Models\BonusBuildingName;
use App\Models\City;
use App\Models\Wall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GlobalTrait;

class BoardPositionController extends Controller
{
    use GlobalTrait;

    public function newBuild($slug)
    {
        if($slug > 1 && $slug <= 7){
            $city = City::where('idUser', Auth::id())->first();

            $loadPositions = BoardPosition::where('idCity', $city->id)->get();

            $builds = [
                '1' => [
                    'link' => config('globalVariables.link.store'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newStore/',
                    'name'=>'Magazyn',
                    'description'=>'Magazyn to budynek w którym surowce są chronione przed atakiem wrogiego miasta. Każdy następny poziom magazynu zwiększa ilość chronionych zasobów w przypadku przegranej obrony miasta.',
                    'wood'=>2000,
                    'stone'=>2000,
                    'pos'=>$slug,
                ],
                '2' => [
                    'link' => config('globalVariables.link.stable'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newStable/',
                    'name'=>'Stajnia',
                    'description'=>'Konie to dodatkowa pomoc w pracy populacji. Wydajność jednego zwierzęcia to dwukrotność wydajności człowieka w pracy. Każdy kolejny poziom stajni zwiększa maksymalną liczbe koni.
                    Współczynnik przyrostu liczby koni zależy od jedzenia w mieście oraz aktualnej liczby koni.',
                    'wood'=>5000,
                    'stone'=>5000,
                    'pos'=>$slug,
                    ],
                '3' => [
                    'link' => config('globalVariables.link.university'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newUniversity/',
                    'name'=>'Akademia',
                    'description'=>'W akademii odybwają się badania naukowe, dzięki którym możesz badać nowe budynki. Można rekrutować naukowców spośród wolnej populacji.
                  Każdy naukowiec zdobywa dla miasta 10 punktów technoligii na godzine.
                  Każdy kolejny poziom akademii zwiększa maksymalną liczbę naukowców.
                  Zrekrutowanie naukowca kosztuje 100 monet.',
                    'wood'=>3000,
                    'stone'=>3000,
                    'pos'=>$slug,
                    ],
                '4' => [
                    'link' => config('globalVariables.link.army'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newArmy/',
                    'name'=>'Koszary',
                    'description'=>'Koszary to miejsce w którym zarządza się wojskiem.
                        Można rekrutować żołnierzy spośród wolnej populacji (200 drewna, 100 złota/szt. domyślnie), co zwiększa szanse podczas najazdu wrogiej wioski, lub w czasie napadu na inną wioskę.
                        Każdy kolejny poziom koszar zwiększa maksymalną liczbę żołnierzy.',
                    'wood'=>2000,
                    'stone'=>2000,
                    'pos'=>$slug,
                    ],
                '5' => [
                    'link' => config('globalVariables.link.woodcutter'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newWoodcutter/',
                    'name'=>'Drwal',
                    'description'=>' Każdy kolejny poziom drwala zwiększa wydobycie drewna przez populacje w czasie godziny.
                      Podstawowe wydobycie miasta to +10 drewna/h .',
                    'wood'=>10000,
                    'stone'=>10000,
                    'pos'=>$slug,
                    ],
                '6' => [
                    'link' => config('globalVariables.link.stonemason'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newStonemason/',
                    'name'=>'Kamieniarz',
                    'description'=>'Każdy kolejny poziom kamieniarza zwiększa wydobycie kamienia przez populacje w czasie godziny.
                      Podstawowe wydobycie miasta to +10 kamienia/h .',
                    'wood'=>10000,
                    'stone'=>10000,
                    'pos'=>$slug,
                    ],
                '7' => [
                    'link' => config('globalVariables.link.mill'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newMill/',
                    'name'=>'Młyn',
                    'description'=>'  Każdy kolejny poziom młyna zwiększa zdobywanie jedzenia przez populacje w czasie godziny.
                      Podstawowe wydobycie miasta to +10 jedzenia/h .',
                    'wood'=>10000,
                    'stone'=>10000,
                    'pos'=>$slug,
                    ],
                '8' => [
                    'link' => config('globalVariables.link.engineer'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newEngineer/',
                    'name'=>'Inżynier',
                    'description'=>' Każdy kolejny poziom inżyniera zmiejsza ilość wymaganych surowców do rekrutacji nowego żołnierza.',
                    'wood'=>10000,
                    'stone'=>10000,
                    'pos'=>$slug,
                    ],
                '9' => [
                    'link' => config('globalVariables.link.architect'),
                    'ownedTechnology' => 'true',
                    'route'=>'/newArchitect/',
                    'name'=>'Architekt',
                    'description'=>' Każdy kolejny poziom architekta zmniejsza ilość wymaganych surowców do rozbudowy budynków w mieście.',
                    'wood'=>10000,
                    'stone'=>10000,
                    'pos'=>$slug,
                    ],
            ];

            foreach ($loadPositions as $loadPosition) {

                if ($loadPosition->idStore !== NULL) {
                    $builds['1'] = NULL;
                }

                if ($loadPosition->idStable !== NULL) {
                    $builds['2'] = NULL;
                }

                if ($loadPosition->idArmy !== NULL) {
                    $builds['4'] = NULL;
                }

                if ($loadPosition->idUniversity !== NULL) {
                    $builds['3'] = NULL;

                }

                if ($loadPosition->idBonusBuilding !== NULL) {

                    $build = BonusBuilding::where('id', $loadPosition->idBonusBuilding)->first();
                    $buildsNames = BonusBuildingName::where('id', $build->idBonusBuildingName)->first();


                    if ($buildsNames->name === 'DRWAL')
                        $builds['5'] = NULL;
                    if ($buildsNames->name === 'KAMIENIARZ')
                        $builds['6'] = NULL;
                    if ($buildsNames->name === 'MŁYN')
                        $builds['7'] = NULL;
                    if ($buildsNames->name === 'INŻYNIER')
                        $builds['8'] = NULL;
                    if ($buildsNames->name === 'ARCHITEKT')
                        $builds['9'] = NULL;
                }
            }
           return view('layouts.newBuild',['cityName' => $city->cityName,
               'gold' => $city->gold,
               'wood' => $city->wood,
               'stone' => $city->stone,
               'food' =>$city->food,
               'builds'=>$builds
               ]);
        }
        else {
            //mur 'wall'=>[
            //                'link'=>'https://cdn.imageupload.workers.dev/K3qZyeBE_mur-wyciety.png',
            //                'ownedTechnology'=>'true'],
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  \App\Models\BoardPosition  $boardPosition
     * @return \Illuminate\Http\Response
     */
    public function show(BoardPosition $boardPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoardPosition  $boardPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(BoardPosition $boardPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoardPosition  $boardPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoardPosition $boardPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoardPosition  $boardPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoardPosition $boardPosition)
    {
        //
    }
}
