@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column">
            <!-- TOKEN VALID -->
                    <div class="success-form-checkout columns">
                        <div class="column has-text-centered">
                            <h3>Senha Alterada com Sucesso !!</h3>
                        </div>
                    </div>
                <!-- END TOKEN VALID -->
                <div class="columns">
                    <div class="column has-text-centered">
                        <p class="link-2"><a href="{{ config('app.font_end_url') }}/login"> Acesso a Área de Login</a></p>
                    </div>
                </div>
        </div>
    </div>
@endsection
