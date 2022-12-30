@extends('home')

@section('board')
    <div class="board">
        <div class="infoBar">
            <div class="infoBarLine"> <div class="icon"><img src="https://cdn-icons-png.flaticon.com/512/542/542288.png"></div>  Moje miasto: {{$cityName}} </br> </div>
            <div class="infoBarLine"> <div class="icon"><img src="https://cdn-icons-png.flaticon.com/512/482/482506.png"></div>  Złoto: {{$gold}} </br></div>
            <div class="infoBarLine"> <div class="icon"><img src="https://cdn-icons-png.flaticon.com/512/2077/2077113.png"></div> Drewno: {{$wood}}</div>
            <div class="infoBarLine"><div class="icon"><img src="https://cdn4.iconfinder.com/data/icons/build-a-house-outline/512/concrete_plaster_stone_structure_surface_cement_wallpaper-256.png"></div> Kamień: {{$stone}}</div>
            <div class="infoBarLine"><div class="icon"><img src="https://cdn-icons-png.flaticon.com/512/3814/3814554.png"></div> Żywność: {{$food}}</div>

        </div>
        <div class="build">
            <div class="buildInfo1">
                <div class="buildTitle">Młyn - Poziom {{$level}}</div>
                <img src="https://cdn.imageupload.workers.dev/4B09lXwY_mlyn-wyciety.png">
                <div class="buildBack">
                    <div class="building">
                        <div>
                            <a href="/wp.pl">
                                <div>Rozbuduj do {{$level+1}} poziomu</div>
                                <div>
                                    <img src="https://cdn0.iconfinder.com/data/icons/miscellaneous-35-line/128/build_construction_house_making_harmer_-256.png">
                                </div>
                            </a>
                        </div>
                            <div>
                                Tępo zdobywania jedzenia na {{$level+1}} poziomie:&nbsp+{{$agroRatio+$bonusUpgrade}}/h </br>
                                Wymagania:</br>
                                Drewno: {{$woodNeed}}</br>
                                Kamień: {{$stoneNeed}}</br>
                                Czas rozbudowy:{{(int)($buildTime/3600)}}h {{(int)(($buildTime/3600-(int)($buildTime/3600))*60)}}min</br>
                            </div>

                        </div>
                    <div class="back">
                        <a href="/">
                            <div>Powrót do miasta</div>
                            <img src="https://cdn4.iconfinder.com/data/icons/navigation-40/24/back-256.png">
                        </a>
                    </div>
                    </div>

                </div>



            <div class="buildInfo2">
              <div class="buildInfo">
                <h1>Młyn</h1>
                  <div>
                      Każdy kolejny poziom młyna zwiększa zdobywanie jedzenia przez populacje w czasie godziny.
                      Podstawowe wydobycie miasta to +10 jedzenia/h .


                  </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane młyna</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/3814/3814554.png"></div>Aktualne tępo zdobywania jedzenia:&nbsp+{{$agroRatio}}/h</div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons.flaticon.com/png/512/1357/premium/1357714.png?token=exp=1640872388~hmac=00f74f1d1973069bb383b04b11b4cd12"></div>Aktualny bonus:&nbsp+{{$bonus}}/h</div>


                    </div>
              </div>

            </div>

        </div>
    </div>






@endsection
