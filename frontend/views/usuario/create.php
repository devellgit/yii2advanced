<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Novo usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
		    <div class="box-header with-border">
		      <h4><?= $this->title?></h4>
		    </div>
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
