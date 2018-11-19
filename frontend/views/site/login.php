<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <img src="img/logo.png" width="200px;">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?php
            echo $form->field($model, 'username')
            ->textInput(['autofocus' => true])
            ->label('Usuário')
        ?>

        <?php
            echo $form->field($model, 'password')
            ->passwordInput()
            ->label('Senha')
        ?>



        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox()->label("Lembrar") ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>

        <?php ActiveForm::end(); ?>

<!--         <center><p>Ainda não é cadastrado?</p></center>
        <div class="row">
            <div class="col-xs-12">
                <a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>" class="btn btn-success btn-block"><b>Efetuar cadastro</b></a>
            </div>
        </div> -->

        <a href="<?= \yii\helpers\Url::to(['/site/request-password-reset']) ?>">Esqueci minha senha</a><br>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

