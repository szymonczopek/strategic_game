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
                <div class="buildTitle">Armia - Poziom {{$level}}</div>
                <img src="https://cdn.imageupload.workers.dev/qoOhiYyN_koszary-wyciete.png">
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
                                Maksymalna liczba żołnierzy na {{$level+1}} poziomie: {{$armyMax*$armyMaxRatio}}</br>
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
                <div><h1> Koszary</h1></div>
                  <div>

                        Koszary to miejsce w którym zarządza się wojskiem.
                      Można rekrutować żołnierzy spośród wolnej populacji (200 drewna, 100 złota/szt. domyślnie), co zwiększa szanse podczas najazdu wrogiej wioski, lub w czasie napadu na inną wioskę.
                      Każdy kolejny poziom koszar zwiększa maksymalną liczbę żołnierzy.


                  </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane koszar</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/1065/1065420.png"></div> Liczba żołnierzy:&nbsp{{$armyAmount}} / {{$armyMax}}</div>
                        <div class="workLine"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/2260/2260829.png">Aktualny koszt żołnierza:</div> <div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/2077/2077113.png"></div><div>Drewno:&nbsp{{$woodCost}}&nbsp</div></div><div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/482/482506.png"></div><div>Złoto:&nbsp{{$goldCost}}</div></div></div>

                    </div>
              </div>
                <div class="work">
                    <h1>Rekrutuj żołnierzy</h1>
                    <form method="POST" action="{{route('army.store')}}">
                        @csrf

                        <div class="workLine" id="workLineTitle">
                            <div>
                                Wolna populacja z której możesz rekrutować żołnierzy: {{$populationFree}}
                            </div>
                        </div>
                        </br>

                        <div class="workLine">
                            <div class="scientistIcon">
                                <div class="iconWork">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1065/1065420.png">
                                </div>
                                <div>
                                    @if($armyMax-$armyAmount>0) Na tym poziomie możesz jeszcze zrekrutować : {{$armyMax-$armyAmount }} żołnierzy
                                    @else Maksymalna liczba żołnierzy na tym poziomie została osiągnięta. Rozbuduj Koszary.
                                    @endif
                                </div>
                            </div>
                            <div>
                                <input name="armyAmount" type="number" value="{{$armyMax-$armyAmount}}" max="{{$armyMax-$armyAmount}}" min="1">
                            </div>
                            <div>X</div>
                            <div>
                               <div> &nbsp{{$woodCost}}&nbsp drewna &nbsp </div><div>{{$goldCost}}&nbsp złota</div>
                            </div>

                        </div>

                        <div class="workLine"><div></div><button type="submit">Rekrutuj żołnierzy</button><div></div></div>

                    </form>
                </div>
            </div>

            <div class="buildInfo2">
                <div class="buildInfo">
                    <div><h1> Koszary</h1></div>
                    <div>

                        Koszary to miejsce w którym zarządza się wojskiem.
                        Można rekrutować żołnierzy spośród wolnej populacji (200 drewna, 100 złota/szt. domyślnie), co zwiększa szanse podczas najazdu wrogiej wioski, lub w czasie napadu na inną wioskę.
                        Każdy kolejny poziom koszar zwiększa maksymalną liczbę żołnierzy.


                    </div>
                </div>
                <div class="mainInfo">
                    <h1> Dane koszar</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/1065/1065420.png"></div> Liczba żołnierzy:&nbsp{{$armyAmount}} / {{$armyMax}}</div>
                        <div class="workLine"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/2260/2260829.png">Aktualny koszt żołnierza:</div> <div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/2077/2077113.png"></div><div>Drewno:&nbsp{{$woodCost}}&nbsp</div></div><div class="scientistIcon"><div class="iconWorkInfo"><img src="https://cdn-icons-png.flaticon.com/512/482/482506.png"></div><div>Złoto:&nbsp{{$goldCost}}</div></div></div>

                    </div>
                </div>
                <div class="work">
                    <h1>Rekrutuj żołnierzy</h1>
                    <form method="POST" action="{{route('army.store')}}">
                        @csrf

                        <div class="workLine" id="workLineTitle">
                            <div>
                                Wolna populacja z której możesz rekrutować żołnierzy: {{$populationFree}}
                            </div>
                        </div>
                        </br>

                        <div class="workLine">
                            <div class="scientistIcon">
                                <div class="iconWork">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1065/1065420.png">
                                </div>
                                <div>
                                    @if($armyMax-$armyAmount>0) Na tym poziomie możesz jeszcze zrekrutować : {{$armyMax-$armyAmount }} żołnierzy
                                    @else Maksymalna liczba żołnierzy na tym poziomie została osiągnięta. Rozbuduj Koszary.
                                    @endif
                                </div>
                            </div>
                            <div>
                                <input name="armyAmount" type="number" value="{{$armyMax-$armyAmount}}" max="{{$armyMax-$armyAmount}}" min="1">
                            </div>
                            <div>X</div>
                            <div>
                                <div> &nbsp{{$woodCost}}&nbsp drewna &nbsp </div><div>{{$goldCost}}&nbsp złota</div>
                            </div>

                        </div>

                        <div class="workLine"><div></div><button type="submit">Rekrutuj żołnierzy</button><div></div></div>

                    </form>
                </div>
            </div>

        </div>
    </div>






@endsection
