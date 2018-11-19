<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PacienteSearch;
use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $model frontend\models\PacienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?php
            if (!Yii::$app->user->isGuest)
            {
        ?>
            <!-- Sidebar user panel -->
            <div class="user-panel">
                 <div class="pull-left image">
                    <img src="img/anonimo.png" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Olá <?= Yii::$app->user->identity->firstName; ?> !</p>
                </div>
            </div>
        <?php
            }
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    // ['label' => 'Menu', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Meu perfil',
                        'icon' => 'fa fa-user',
                        'url' => ['usuario/update', 'id'=>Yii::$app->user->identity->id],
                        'visible'=> (!Yii::$app->user->isGuest)
                    ],
                    [
                        'label' => 'Agendamentos',
                        'icon' => 'fa fa-calendar-check-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Calendário', 'icon' => 'fa fa-calendar', 'url' => ['agendamento/index'],],
                            [
                                'label' => 'Relatório', 
                                'icon' => 'fa fa-list', 
                                'url' => ['agendamento/index2'],
                                'visible'=>!Yii::$app->user->isGuest && 
                                    (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)
                            ],
                        ],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN || Yii::$app->user->identity->perfil == Usuario::PERFIL_ATENDENTE || Yii::$app->user->identity->perfil == Usuario::PERFIL_SECRETARIA)
                    ],
                    // [
                    //     'label' => 'Agenda',
                    //     'icon' => 'fa fa-calendar',
                    //     'url' => ['agendamento/index'],
                    //     'visible'=>!Yii::$app->user->isGuest && 
                    //         (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN || Yii::$app->user->identity->perfil == Usuario::PERFIL_ATENDENTE || Yii::$app->user->identity->perfil == Usuario::PERFIL_SECRETARIA)
                    // ],
                    [
                        'label' => 'Cadastros',
                        'icon' => 'fa fa-edit',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Serviços', 'icon' => 'fa fa-cog', 'url' => ['servico/index'],],
                            ['label' => 'Locais', 'icon' => 'fa fa-building', 'url' => ['local/index'],],
                            ['label' => 'Usuários', 'icon' => 'fa fa-users', 'url' => ['usuario/index'],],
                        ],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)
                    ],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Sair', 'url' => ['site/logout'], 'visible' => !Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
