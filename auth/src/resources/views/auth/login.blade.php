@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <div class="field-body-col columns" >
                        <div class="column">
                            <input id="email_cpf" type="text" placeholder="Email" class="form-control ipone @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email_cpf')
                            <p class="error-msg" role="alert">
                              {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="field-body-col columns" >
                        <div class="column">
                            <input id="password" type="password" placeholder="Senha" class="form-control ipone @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <p class="error-msg" role="alert">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <div class="field">
                    <div class="container-login100-form-btn has-text-centered">
                        <button type="submit" class="btn-submit-blue-one btn_full">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
