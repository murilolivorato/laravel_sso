@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- card -->
        <div class="card">

            <div class="card-header header-pg">
                <h1>Editar Senha do Usuários</h1>
            </div>


            <!-- card-body -->
            <div class="card-body  card_form card-form" >
                @if($status == "success")
                    <div class="success-form-checkout columns">
                        <div class="column has-text-centered">
                            <h3>A Sua Senha Foi ALterada com SUcesso !!</h3>
                        </div>
                    </div>
                @else
                <form class="main_form" method="POST"  action="{{ route('update_password') }}" >
                    @csrf
                    <fieldset>

                        <!-- field block -->
                        <div class="field is-horizontal" >
                            <div class="field-label is-normal">
                                <label class="is-required">Senha Antiga</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <input class="form-control ipone"   placeholder="Senha"  type="password" name="old_password" >
                                    @if($status == "error")
                                        <div class="error-msg">Houve um Erro, Contate o Suporte !!</div>
                                    @endif
                                    @error('old_password')
                                    <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- field block -->

                        <!-- field block -->
                        <div class="field is-horizontal" >
                            <div class="field-label is-normal">
                                <label class="is-required">Nova Senha</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <input class="form-control ipone"   placeholder="Senha"  type="password"  name="password" >
                                    @error('password')
                                    <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- field block -->

                        <!-- field block -->
                        <div class="field is-horizontal"  >
                            <div class="field-label is-normal">
                                <label class="is-required">Confirmação de Senha</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <input class="form-control ipone"   placeholder="Confirmação de Senha"  type="password"  name="password_confirmation"  >
                                    @error('password_confirmation')
                                    <div class="error-msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- field block -->

                    </fieldset>

                    <!-- field block -->
                    <div class="field is-horizontal button-area"  >
                        <div class="field-label is-normal">
                        </div>
                        <div class="field-body">
                            <button type="submit" class="btn_cl_left button is-link">
                                Alterar Senha
                            </button>
                        </div>
                    </div>
                    <!-- field block -->
                </form>
                @endif
            </div>
            <!-- end card-body -->
        </div>
        <!-- card -->

    </div>
@endsection
