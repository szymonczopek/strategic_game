@extends('home')

@section('board')
    <div class="board">

<div class="city">
    <div class="buildEnd">
        <div class="errorDiv">
           <div>{{$messege}}</div>
                <div class="back">
                    <a href="/">
                        <div>Powrót do miasta</div>
                        <img src="https://cdn4.iconfinder.com/data/icons/navigation-40/24/back-256.png">
                    </a>
                </div>
            </div>
    </div>

</div>
    </div>
@endsection
