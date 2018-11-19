<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use common\models\Agendamento;

class AgendamentoController extends ActiveController
{
    public $modelClass = 'common\models\Agendamento';

	// public function behaviors()
	// {
	//     $behaviors = parent::behaviors();
	//     $behaviors['authenticator'] = [
	//     	'class' => QueryParamAuth::className(),
	//     ];
	//     return $behaviors;
	// }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }


    public function actionIndex($idPaciente)
    {
    	return Agendamento::find()->andWhere('id_paciente='.$idPaciente)->all();
    }
}