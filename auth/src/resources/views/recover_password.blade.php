@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column">
                @if($data['token_valid'])
                <!-- TOKEN VALID -->
                <div>
                    <h2>Alterar Senha </h2>
                    <form method="POST"  action="{{ route('postRecoverPass') }}" >
                        <input type="hidden"  name="token" value="{{ $token  }}">
                        @csrf
                        <fieldset>
                            <div class="field" >
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <label class="label">Nova Senha </label >
                                            <input class="form-control ipone" type="password"  name="password" >
                                            @error('password')
                                            <div class="error-msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field" >
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <label class="label">Confirmação de Senha </label >
                                            <input class="form-control ipone"  type="password" name="password_confirmation"  >
                                            @error('password_confirmation')
                                            <div class="error-msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="btn-submit-blue-one btn_full">
                                        Alter Senha
                                    </button>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <ul class="more-dt-login">
                                        <li><a href="{{ config('app.font_end_url') }}"> Acesso a Área de Login</a></li>
                                    </ul>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <!-- END TOKEN VALID -->

                @else
                <!-- TOKEN NOT VALID -->
                <div v-else>
                    <div class="columns header-text-msg">
                        <div class="column">
                            <h1>
                                Link Inválido
                            </h1>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="container-login100-form-btn">
                                <p class="p_sm_1">O Link é inválido ou expirou o prazo de 24 hs para redefinir a sua senha . Nos Informe o seu e-mail de novo na área de acesso em "Esqueceu a Senha" . </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TOKEN NOT VALID -->
                @endif
        </div>
    </div>
@endsection
