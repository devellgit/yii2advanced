<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = '';//$name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                O erro acima ocorreu quando você tentamos processar sua solicitação.
                Por favor, entre em contato com o administrador do sistema.
                Se preferir, <a href='<?= Yii::$app->homeUrl ?>'>volte para a página inicial</a>.
            </p>

        </div>
    </div>

</section>
