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
    <div class="city">
        <div class="background">
            <div class="addBuild">
                <div class="newBuildTitle">
                    <div class="addBuildLine"><div>Nazwa</div><div><img src=""></div><div>Opis</div><div>Wymagania:</div></div>
                    <div class="newBuildBack">
                        <a href="/">
                            <div>Powrót do miasta</div>
                            <img src="https://cdn4.iconfinder.com/data/icons/navigation-40/24/back-256.png">
                        </a>
                    </div>
                </div>
            @for($i=1;$i<=9;$i++)
                    @if($builds[$i] !== NULL)
                        <div class="addBuildLine"><div>{{$builds[$i]['name']}}</div><div><img src="{{$builds[$i]['link']}}"></div><div>{{$builds[$i]['description']}}</div><div><div>Drewno:{{$builds[$i]['wood']}}</div><div>Kamien:{{$builds[$i]['stone']}}</div></div><div> <form method="POST" action="{{$builds[$i]['route']}}{{$builds[$i]['pos']}}">@csrf<button type="submit">Wybuduj</button></form></div></div>
                    @endif
                    @endfor


           </div>

        {{-- @for($i=1;$i<=9;$i++)
             @if($builds[$i]['name'] !== NULL)
               {{$builds[$i]['name']}} </br>
           @endif
           @endfor--}}

        </div>
    </div>





    </div>
@endsection
