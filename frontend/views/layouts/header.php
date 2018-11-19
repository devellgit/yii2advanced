<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UsuarioSearch;
use common\models\Usuario;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><img src="img/icone.png" style="width:40px; max-height: 60px; margin-top: 10px;"></span><span class="logo-lg"><img src="img/logo.png" style="width:80%;max-height: 60px;margin:5px 0;"></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header>
