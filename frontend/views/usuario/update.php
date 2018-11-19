<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$this->title = 'Editar usuário: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
</div>
