@extends('home')

@section('board')
<div class="log">



        <h1>{{ __('Zmień hasło') }}</h1>


                    <form method="POST" action="{{route('changePassword')}}">
                        @csrf
                        Aktualne hasło <input id="currentPassword" type="password"  name="currentPassword" value="{{ old('currentPassword') }}" autofocus>
                        @error('currentPassword')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        Nowe hasło <input id="newPassword" type="password"  name="newPassword" value="{{ old('newPassword') }}" autofocus>
                        @error('newPassword')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        Powtórz hasło <input id="confirmPassword" type="password"  name="confirmPassword" value="{{ old('confirmPassword') }}" autofocus>
                        @error('confirmPassword')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <button type="submit">
                                    {{ __('Zmień hasło') }}
                        </button>

                    </form>




</div>
</div>
@endsection
