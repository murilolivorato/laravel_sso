@extends('layouts.app')

@section('content')
    @if($status == "success")
    <div class="success-form-checkout columns">
        @if($user_email)
        <div class="column has-text-centered">
            <h3>Um e-mail de recuperação foi enviado para {{$user_email}}. Siga as instruções.</h3>
        </div>
        @else
            <div class="column has-text-centered">
                    <h3>Um e-mail de recuperação foi enviado para você . Siga as instruções.</h3>
            </div>
        @endif
    </div>
    <div class="columns">
        <div class="column has-text-centered">
            <ul class="more-dt-login">
                <li><a href="{{ config('app.font_end_url') }}/esqueceu-a-senha"> Acesso a Área de Login</a></li>
            </ul>
        </div>
    </div>
    @else
    <div class="columns desc-form">
        <div class="column">
            <p class="p_sm_1">Did you forgot the password ? follow those insctructions</p>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <form method="POST" action="{{ route('postResetPass') }}">
                @csrf
                <fieldset>
                    <div class="field-body-col columns" >
                        <div class="column">
                            <input class="form-control ipone" name="email_cpf" placeholder="E-mail ou CPF"  type="text"  >
                            @if($status == "error")
                                <div class="error-msg">E-mail ou CPF não encontrado em nosso cadastro. Tente informar o CPF ou entre em contato com seu gestor.</div>
                            @endif
                            @error('email_cpf')
                            <p class="error-msg" role="alert">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>
                </div>

                    <div class="columns">
                        <div class="column">
                            <div class="container-login100-form-btn">
                                <button type="submit" class="btn-submit-blue-one btn_full">
                                    Recuperar Senha
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column has-text-centered">
                            <ul class="more-dt-login">
                                <li><a href="{{ config('app.font_end_url') }}/login"> Acesso a Área de Login</a></li>
                            </ul>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    @endif
@endsection
