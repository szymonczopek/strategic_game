@extends('home')

@section('board')
<div class="log">



        <h1>{{ __('Zaloguj') }}</h1>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <label for="email">{{ __('Adres e-mail ') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror




                            <label for="password" >{{ __('Hasło') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zaloguj') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Przypomnij hasło') }}
                                    </a>
                                @endif


                    </form>




</div>
</div>
@endsection
