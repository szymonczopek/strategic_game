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
                <div class="buildTitle">Akademia - Poziom {{$level}}</div>
                <img src="https://cdn.imageupload.workers.dev/RXpopXSO_akademia-wyciety.png">
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
                                Maksymalna liczba naukowcow na {{$level+1}} poziomie: {{($scientistsMax)*($scientistsMaxRatio)}}</br>
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
                <div><h1> Akademia</h1></div>
                 <div>  W akademii odybwają się badania naukowe, dzięki którym możesz badać nowe budynki. Można rekrutować naukowców spośród wolnej populacji.
                  Każdy naukowiec zdobywa dla miasta 10 punktów technoligii na godzine.
                  Każdy kolejny poziom akademii zwiększa maksymalną liczbę naukowców.
                  Zrekrutowanie naukowca kosztuje 100 monet.
                 </div>
              </div>
                <div class="mainInfo">
                 <h1> Dane akdemii</h1>
                    <div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/1087/1087927.png"></div> Punkty technologii: {{$technologyPoints}}</div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-vitaly-gorbachev/344/external-scientist-female-profession-vitaliy-gorbachev-lineal-vitaly-gorbachev-1.png"></div> Naukowcy: {{$scientists}}/{{$scientistsMax}}</div>
                        <div class="infoLine"> <div class="iconWork"><img src="https://cdn-icons-png.flaticon.com/512/3500/3500797.png"></div> Postępy badań: +{{$scienceRatio}} punktów technologii/s</div>

                    </div>

              </div>
                <div class="work">
                    <h1>Badania</h1>
                    <form method="POST" action="{{route('university.store')}}">
                        @csrf

                        <div class="workLine" id="workLineTitle">
                            <div>
                                Wolna populacja z której możesz rekrutować naukowców: {{$populationFree}}
                            </div>
                        </div>
                        </br>
                        <div class="workLine">
                            <div class="scientistIcon">
                                <div class="iconWork">
                                    <img src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-vitaly-gorbachev/344/external-scientist-female-profession-vitaliy-gorbachev-lineal-vitaly-gorbachev-1.png">
                                </div>
                                <div>
                                   @if($scientistsMax-$scientists>0) Na tym poziomie możesz jeszcze zrekrutować : {{$scientistsMax-$scientists }} naukowców
                                    @else Maksymalna liczba naukowców na tym poziomie została osiągnięta. Rozbuduj Akademię.
                                    @endif
                                </div>
                            </div>
                            <div>
                                <input name="scientists" type="number" value="{{$scientistsMax-$scientists}}" max="{{$scientistsMax-$scientists}}" min="1">x100 zlota
                            </div>
                            <div>
                                 +10 punktów technologii/s
                            </div>

                        </div>

                        <div class="workLine"><div></div><button type="submit">Rekrutuj naukowców</button><div></div></div>

                    </form>
                </div>
            </div>

        </div>
    </div>






@endsection
