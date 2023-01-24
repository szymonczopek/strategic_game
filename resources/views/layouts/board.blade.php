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

<div class="background"><img src="https://cdn.imageupload.workers.dev/RZdNhUl1_tlo.png">
    @if(isset($sends[8]['link']))
        <div class="pos8"><img src="{{$sends[8]['link']}}"><a href="{{$sends[8]['name']}}"><img src="https://cdn.imageupload.workers.dev/GUkKYoRS_flaga_wycieta.png"><ul><li>{{$sends[8]['name']}}</li></ul></a></div>
    @else <div class="pos8null" ><div><a href="newBuild/wall"><img src="https://cdn.imageupload.workers.dev/ZnCq4aBE_flaga_wycieta.png"></a></div></div>
    @endif
    @for($i=1;$i<=7;$i++)
        @if(isset($sends[$i]['link']))
            <div class="pos{{$i}}"><a href="{{$sends[$i]['name']}}"><img src="{{$sends[$i]['link']}}"><ul><li>{{$sends[$i]['name']}}</li></ul></a></div>
            @else <div class="pos{{$i}}" ><a href="newBuild/{{$i}}"><img src="https://cdn.imageupload.workers.dev/ZnCq4aBE_flaga_wycieta.png"></a></div>
        @endif
    @endfor


</div>

</div>





    </div>
@endsection
