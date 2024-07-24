<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bulma/bulma-rtl.css') }}" rel="stylesheet">

    <style>
        .passport-authorize .container {
            margin-top: 30px;
        }

        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }
    </style>
</head>
<body class="passport-authorize">
<div class="container">
    <div class="columns">
        <div class="column has-text-centered">
            <div class="is-vcentered authorization-card card">
                <h1 class="title">AUTORIZAÇÃO DE ACESSO</h1>
                <div>
                <!--                        <strong><?php echo e($client->name); ?></strong>-->
                    <!-- Introduction -->
                    <p>Esta Aplicação está solicitando a sua permissão para ter acesso com as suas credenciais !</p>

                    <!-- Scope List -->
                <!--                        <?php if(count($scopes) > 0): ?>
                    <div class="scopes">
                            <p><strong>This application will be able to:</strong></p>

                            <ul>
<?php $__currentLoopData = $scopes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scope): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($scope->description); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
            </div>
<?php endif; ?>-->

                    <div class="columns is-mobile is-centered has-text-centered column-autorize-buttons">
                        <div class="column is-half">
                            <div class="columns">
                                <!-- Authorize Button -->
                                <form method="post" action="<?php echo e(route('passport.authorizations.approve')); ?>" class="column">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="state" value="<?php echo e($request->state); ?>">
                                    <input type="hidden" name="client_id" value="<?php echo e($client->id); ?>">
                                    <input type="hidden" name="auth_token" value="<?php echo e($authToken); ?>">
                                    <button class="button is-info is-medium is-rounded"">Autorizar</button>
                                </form>
                                <!-- Cancel Button -->
                                <form method="post" action="<?php echo e(route('passport.authorizations.deny')); ?>" class="column">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <input type="hidden" name="state" value="<?php echo e($request->state); ?>">
                                    <input type="hidden" name="client_id" value="<?php echo e($client->id); ?>">
                                    <input type="hidden" name="auth_token" value="<?php echo e($authToken); ?>">
                                    <button class="button is-light is-medium is-rounded"">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
