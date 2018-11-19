<?php

namespace frontend\controllers;

use Yii;
use common\models\Usuario;
use common\models\UsuarioSearch;
use yii\web\Controller;
use common\components\AccessRule;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'delete', 'index'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            Usuario::PERFIL_SUPER_ADMIN,
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            Usuario::PERFIL_SUPER_ADMIN,
                            Usuario::PERFIL_SECRETARIA,
                            Usuario::PERFIL_ATENDENTE,
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();
        $model->status = 1;

        if ($model->load(Yii::$app->request->post())) {

            $model->setPassword($model->password);
            $model->generateAuthKey();

            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Usuário criado com sucesso.');
                return $this->redirect(['index', 'id' => $model->id]);
            }
            else
            {
                \Yii::$app->getSession()->setFlash('error', 'Erro ao criar usuário.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->password)
            {
                $model->setPassword($model->password);
                $model->generateAuthKey();
            }

            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Usuário salvo com sucesso.');
                if (Yii::$app->user->identity->perfil == Usuario::PERFIL_SUPER_ADMIN)
                    return $this->redirect(['index', 'id' => $model->id]);
                else
                    return $this->redirect(['agendamento/index']);
            }
            else
            {
                \Yii::$app->getSession()->setFlash('error', 'Erro ao salvar usuário.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);

        $model->status = 0;

        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
