<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PacienteSearch;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\PacienteSearch */
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
                    <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
                </div>
                <div class="pull-left info">
                    <p>Olá <?= Yii::$app->user->identity->firstName; ?> !</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        <?php
            }
        ?>

        <?php 
            $model = new PacienteSearch;
            $form = ActiveForm::begin([
                'action' => ['paciente/index'],
                'method' => 'get',
                'options' => [
                    'class' => 'sidebar-form'
                ]
            ]); 
        ?>
        
        <div class="input-group">
            <input type="text" id="pacientesearch-nome" name="PacienteSearch[nome]" class="form-control" placeholder="Busca..."/>
            <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
 
        <?php ActiveForm::end(); ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    // ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Médicos',
                        'icon' => 'fa fa-stethoscope',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Listar', 'icon' => 'fa fa-list', 'url' => ['medico/index'],],
                            ['label' => 'Incluir', 'icon' => 'fa fa-plus', 'url' => ['medico/create'],],
                        ],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)
                    ],
                    [
                        'label' => 'Meu perfil',
                        'icon' => 'fa fa-stethoscope',
                        'url' => ['medico/view', 'id'=>(!Yii::$app->user->isGuest && Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO)?Yii::$app->user->identity->medico->id:0],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO)
                    ],
                    [
                        'label' => 'Minhas secretárias',
                        'icon' => 'fa fa-phone',
                        'url' => ['secretaria/index'],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO)
                    ],
                    [
                        'label' => 'Meus consultórios',
                        'icon' => 'fa fa-hospital-o',
                        'url' => ['consultorio/index'],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO)
                    ],
                    [
                        'label' => 'Modelos de receita',
                        'icon' => 'fa fa-file-text',
                        'url' => ['receita-modelo/index'],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO)
                    ],
                    // [
                    //     'label' => 'Secretárias',
                    //     'icon' => 'fa fa-phone',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Listar', 'icon' => 'fa fa-list', 'url' => ['secretaria/index'],],
                    //         ['label' => 'Incluir', 'icon' => 'fa fa-plus', 'url' => ['secretaria/create', 'idMedico'=>Yii::$app->user->identity->medico->id],],
                    //     ],
                    // ],
                    [
                        'label' => 'Pacientes',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Listar', 'icon' => 'fa fa-list', 'url' => ['paciente/index'],],
                            ['label' => 'Incluir', 'icon' => 'fa fa-plus', 'url' => ['paciente/create'],],
                        ],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO || Yii::$app->user->identity->perfil == Usuario::PERFIL_SECRETARIA)
                    ],
                    // [
                    //     'label' => 'Consultórios',
                    //     'icon' => 'fa fa-hospital-o',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Listar', 'icon' => 'fa fa-list', 'url' => ['consultorio/index'],],
                    //         ['label' => 'Incluir', 'icon' => 'fa fa-plus', 'url' => ['consultorio/create'],],
                    //     ],
                    // ],
                    [
                        'label' => 'Minha agenda',
                        'icon' => 'fa fa-calendar-check-o',
                        'url' => ['consulta/index'],
                        'visible'=>!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->perfil == Usuario::PERFIL_MEDICO || Yii::$app->user->identity->perfil == Usuario::PERFIL_SECRETARIA)
                    ],
                    [
                        'label' => 'Configurações',
                        'icon' => 'fa fa-cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Tipos de exame (imagem)', 'icon' => 'fa fa-cog', 'url' => ['tipo-exame-imagem/index'],],
                            ['label' => 'Tipos de exame (laboratoriais)', 'icon' => 'fa fa-cog', 'url' => ['exames-padrao/create'],],
                            ['label' => 'Regiões do corpo', 'icon' => 'fa fa-cog', 'url' => ['regiao-exame/index'],],
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
