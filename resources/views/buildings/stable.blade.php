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
                <div class="buildTitle">Stajnia - Poziom {{$level}}</div>
                <img src="{{$stablePicture}}">
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
                                Maksymalna liczba koni na {{$level+1}} poziomie: {{$horseMax*$horseMaxRatio}}</br>
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
                <div><h1> Stajnia</h1></div>
                  <div>

                        Konie to dodatkowa pomoc w pracy populacji. Wydajność jednego zwierzęcia to dwukrotność wydajności człowieka w pracy. Każdy kolejny poziom stajni zwiększa maksymalną liczbe koni.
                      Współczynnik przyrostu liczby koni zależy od jedzenia w mieście oraz aktualnej liczy koni.


                  </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane stajni</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn4.iconfinder.com/data/icons/marketing-and-digital-marketing-1/32/business_marketing_advertising_competition-512.png"></div> Liczba koni:&nbsp{{$horseAmount}} / {{$horseMax}}</div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/3500/3500797.png"></div>  Współczynnik przyrostu liczby koni:&nbsp @if($horseRatio>0) +{{$horseRatio}}@else{{$horseRatio}}@endif/h</div>

                    </div>
              </div>

            </div>

        </div>
    </div>






@endsection
