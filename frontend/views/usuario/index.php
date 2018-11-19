<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-header with-border">
                <?= Html::a('Novo usuário', ['create'], ['class' => 'btn btn-success pull-right']) ?>
            </div>

            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => "Mostrando de {begin} a {end} de {totalCount} usuários",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        
                        'firstName',
                        'username',
                        [
                            'attribute' => 'perfil',
                            'label' => 'Perfil',
                            'value' => function ($data) {
                                return $data->nomePerfil;
                            },
                            'filter' => [ Usuario::PERFIL_SUPER_ADMIN => 'Super Admin', Usuario::PERFIL_ATENDENTE => 'Atendente', Usuario::PERFIL_USUARIO => 'Usuário']
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Status',
                            'value' => function ($data) {
                                return ['Inativo', 'Ativo'][$data->status];
                            },
                            'filter' => [ 0 => 'Inativo', 1 => 'Ativo']
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
