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
                <div class="buildTitle">Magazyn - Poziom {{$level}}</div>
                <img src="https://cdn.imageupload.workers.dev/LGTJOgIp_magazyn-wyciety.png">
                <div class="buildBack">
                    <div class="building">
                        <div>
                            <a href="">
                                <div>Rozbuduj do {{$level+1}} poziomu</div>
                                <div>
                                    <img src="https://cdn0.iconfinder.com/data/icons/miscellaneous-35-line/128/build_construction_house_making_harmer_-256.png">
                                </div>
                            </a>
                        </div>
                            <div>
                                Ochrona surowców na {{$level+1}} poziomie: {{$protectedStock*$protectedStockRatio}}</br>
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
                <h1> Magazyn</h1>
                  <div>
                       Magazyn to budynek w którym surowce są chronione przed atakiem wrogiego miasta. Każdy następny poziom magazynu zwiększa ilość chronionych zasobów w przypadku przegranej obrony miasta.


                  </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane magazynu</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/2488/2488702.png"></div> Ilość bezpicznych surowców:&nbsp{{$protectedStock}}</div>


                    </div>
              </div>

            </div>

        </div>
    </div>






@endsection
