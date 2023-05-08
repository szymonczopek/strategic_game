@extends('home')

@section('board')
<div class="log">



        <h1>{{ __('Nazwij swoje miasto') }}</h1>


                    <form method="POST" action="{{route('cities.createCity')}}">
                        @csrf
                        <input id="cityName" type="text"  name="cityName" value="{{ old('cityName') }}" autofocus>
                        @error('cityName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <button type="submit">
                                    {{ __('Stwórz miasto') }}
                        </button>

                    </form>




</div>
</div>
@endsection
