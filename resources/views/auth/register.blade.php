@extends('home')

@section('board')

    <div class="register">

            <h1>{{ __('Rejestracja') }}</h1>


                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa użytkownika') }}</label>


                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail ') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror




                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror




                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Powtórz hasło') }}</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">





                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zarejestruj') }}
                                </button>


                    </form>




</div>
</div>
@endsection
