<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?php 
                    echo $form->field($model, 'perfil')->dropDownList(array(Usuario::PERFIL_SUPER_ADMIN=>"Super Admin",Usuario::PERFIL_SECRETARIA=>"Secretaria", Usuario::PERFIL_ATENDENTE=>"Atendente"), ["prompt"=>"Selecione", 'disabled' => ($model->isNewRecord || Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)?false:true]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => ($model->isNewRecord)?false:true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?php
                if ($model->isNewRecord || Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)
                    echo $form->field($model, 'status')->dropDownList(array(1=>"Ativo", 0=>"Inativo"), ["prompt"=>"Selecione"]);
            ?>
        </div>
    </div>

    <div class="box-bottom">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
