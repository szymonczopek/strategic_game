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
                <div class="buildTitle">Ratusz - Poziom {{$level}}</div>
                <img src="https://cdn.imageupload.workers.dev/eFVt7dB5_ratusz_wyciety.png">
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
                                Maksymalna populacja na {{$level+1}} poziomie: {{$populationMax*$populationMaxRatio}}</br>
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
                <div><h1> Ratusz</h1></div>
                  <div>

                        Ratusz to miejsce zarządzania ludnością. Każdy kolejny poziom budynku zwiększa maksymalną możliwą populacje miasta.
                      Współczynnik populacji określa chęć ludzi do zamiszkania w Twoim mieście. Zależy on od poziomu jedzenia w mieście oraz aktualnej liczy ludności.
                      W tym budynku możesz ustawić ilość pracowników do danej pracy. (Możesz wybudować stajnię, dzięki której liczba pracowników zostanie zwiększona o dwukrotność liczby koni.)
                      Każdy pracownik przynosi określoną liczbe surowców na godzinę. Człowiek wolny płaci podatki. Liczba zdobywanych surowców w czasie godziny może się zwiekszać,
                      dzięki budowie budynków funkcyjnych.


                  </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane miasta</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/900/900783.png"></div> Populacja miasta:@if($horses > 0) &nbsp{{$population+ 2*$horses}} ({{$horses}} koni) / {{$populationMax}} @else&nbsp{{$population}} / {{$populationMax}}</div>@endif
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/3500/3500797.png"></div>  Współczynnik wzrostu populacji:&nbsp @if($populationRatio>0) +{{$populationRatio}}@else{{$populationRatio}}@endif/s</div>

                    </div>
              </div>
                <div class="work">
                    <h1>Praca w mieście</h1>
                        <form method="POST" action="{{route('townhall.changeWorkersAmount')}}">
                            @csrf
                            <div class="workLine" id="workLineTitle"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/1083/1083298.png">Łączna populacja do pracy:</div> <div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/900/900783.png"></div><div>Ludzie:{{$population}}</div></div><div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons.flaticon.com/png/512/4989/premium/4989187.png?token=exp=1640872289~hmac=c654d4f2b896f390b3f1097c7ef283fc"></div><div>Konie:@if($horses===NULL)0 @else{{$horses}}@endif&nbsp x2</div></div></div>
                            <div class="workLine"><div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/482/482506.png"></div><div>Populacja wolna:&nbsp {{$populationFree}}</div><div>{{$populationFree}}&nbspx</div><div>+10&nbspmonet/h</div></div>
                            <div class="workLine"><div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/2077/2077113.png"></div><div>Pracownicy w lesie:&nbsp {{$populationForest}}/{{$populationFree}}</div><div><input name="populationForest" type="number" value="{{$populationForest}}" max="{{$population+2*$horses}}" min="0">&nbspx</div><div>+{{$forestRatio}}&nbspdrewna/h</div></div>
                            <div class="workLine"><div class="iconWork"><img src="https://cdn4.iconfinder.com/data/icons/build-a-house-outline/512/concrete_plaster_stone_structure_surface_cement_wallpaper-256.png"></div><div>Pracownicy w kamieniołomie:&nbsp {{$populationStonepit}}/{{$populationFree}}</div><div><input name="populationStonepit" type="number" value="{{$populationStonepit}}" max="{{$population+2*$horses}}" min="0">&nbsp x</div><div>+{{$stonepitRatio}}&nbspkamienia/h</div></div>
                            <div class="workLine"><div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/3814/3814554.png"></div><div>Pracownicy w polu:&nbsp {{$populationAgro}}/{{$populationFree}}</div><div><input name="populationAgro" type="number" value="{{$populationAgro}}" max="{{$population+2*$horses}}" min="0">&nbspx</div><div>+{{$agroRatio}}&nbsp jedzenia/h</div></div>
                            <div class="workLine"><div></div><button type="submit">Zapisz</button><div></div></div>

                        </form>
                </div>
            </div>

        </div>
    </div>






@endsection
