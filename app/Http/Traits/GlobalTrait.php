<?php

namespace App\Http\Traits;

use App\Models\BoardPosition;
use App\Models\City;
use App\Models\townHall;
use Illuminate\Support\Facades\AutownHall;

trait GlobalTrait {

    public function getCity($user)
    {
        try {
            $city = City::where('idUser', $user)->first();
            if (!$city) {
                throw new Exception("Nie znaleziono miasta tego uzytkownika");
            }
        } catch (Exception $e) {
            $errorMessage = 'Błąd przy pobieraniu modelu: ' . $e->getMessage();
            return $errorMessage;
        }
        return $city;
    }
    public function getCityPositions($city)
        {
            try {
            $loadPositions = BoardPosition::where('idCity',$city->id)->get();
                if (!$loadPositions) {
                throw new Exception("Nie znaleziono pozycji planszy tego uzytkownika");
                }
            } catch (Exception $e) {
                $errorMessage = 'Błąd przy pobieraniu modelu: ' . $e->getMessage();
                return $errorMessage;
        }
        return $loadPositions;
    }
    public function resourcesUpdate($idTownHall, $city)
    {
        try {
            $townHall = TownHall::where('id', $idTownHall)->first();
            if (!$townHall) {
                throw new Exception("Nie znaleziono ratusza tego uzytkownika");
            }
        } catch (Exception $e) {
            $errorMessage = 'Błąd przy pobieraniu modelu: ' . $e->getMessage();
            return $errorMessage;
        }
            //czas wolnych
            $time=time()-$townHall->freeWorkTime;
            $before=$city->gold;
            $city->update(['gold' =>$city->gold + (int)(1/360*$time*$townHall->populationFree)]);
            $after=$city->gold;

            if($after>$before) $townHall->update(['freeWorkTime'=>time()]);

            //czas drewna
            $time=time()-$townHall->woodWorkTime;
            $before=$city->wood;
            $city->update(['wood' => (int)($city->wood + 1/360*$time*$townHall->populationForest*$townHall->forestRatio)]);
            $after=$city->wood;

            if($after>$before) $townHall->update(['woodWorkTime'=>time()]);

            //czas kamien
            $time=time()-$townHall->stoneWorkTime;
            $before=$city->stone;
            $city->update(['stone' => (int)($city->stone + 1/360*$time*$townHall->populationStonepit*$townHall->stonepitRatio)]);
            $after=$city->stone;

            if($after>$before) $townHall->update(['stoneWorkTime'=>time()]);

            //czas jedzenie
            $time=time()-$townHall->agroWorkTime;
            $before=$city->food;
            $city->update(['food' => (int)($city->food + 1/360*$time*$townHall->populationAgro*$townHall->agroRatio)]);
            $after=$city->food;

            if($after>$before) $townHall->update(['agroWorkTime'=>time()]);
        }
        public function endBuild($building){
            if($building->buildEnd-time() <= 0) $building->update(['buildEnd'=>NULL]);
        }

}
