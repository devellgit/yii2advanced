<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use \common\models\Usuario;
/**
 * Default controller for the `api` module
 */
class AuthController extends ActiveController
{
    public $modelClass = 'common\models\Usuario';

    public function actionLogin(){
        //$_POST = json_decode(file_get_contents('php://input'), true);

        // Tangkap data login dari client (username & password)
        $username = !empty($_POST['usuario'])?$_POST['usuario']:'';
        $password = !empty($_POST['senha'])?$_POST['senha']:'';

        $response = [];
        // validasi jika kosong
        if(empty($username) || empty($password)){
          $response = [
            'status' => 0,
            'message' => 'Usuário e senha precisam ser preenchidos.',
            'data' => print_r($_POST, true),
          ];
        }
        else{
            
            $user = Usuario::findByUsername($username);
            
            if(!empty($user)){
              
              if($user->validatePassword($password)){
                if (!$user->authKey)
                {
                  $user->generateAuthKey();
                  $user->save();
                }
                unset($user['passwordHash']);


                $usuario = Usuario::find()->where(['id' => $user->id])->with('paciente','medico')->asArray()->one();
                $response = [
                  'status' => true,
                  'message' => 'login OK!',
                  'data' => $usuario
                ];
              }
              // Jika password salah maka bikin response seperti ini
              else{
                $response = [
                  'status' => false,
                  'message' => 'Password inválido',
                  'data' => '',
                ];
              }
            }
            // Jika username tidak ditemukan bikin response kek gini
            else{
              $response = [
                'status' => false,
                'message' => 'Usuário não encontrado no banco de dados',
                'data' => print_r($_POST, true),
              ];
            }
        }
     
        return $response;
    }

    // public function actionSignup()
    // {
    //     $_POST = json_decode(file_get_contents('php://input'), true);

    //     $nome = $_POST['nome'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $role = $_POST['role'];

    //     $response = [];

    //     if(empty($nome) || empty($password) || empty($email) || empty($role)) {
    //       $response = [
    //         'status' => 'Erro',
    //         'message' => 'Informações incompletas.',
    //         'data' => '',
    //       ];
    //     }
    //     else
    //     {
    //         $user = new \common\models\Usuario();
    //         $user->username = $email;
    //         $user->email = $email;
    //         $user->setPassword($password);
    //         $user->generateAuthKey();

    //         $user->name = $nome;
    //         $user->role = $role;
            
    //         $configuracao = \frontend\models\Configuracao::find()->all();

    //         if ($user->role == \common\models\Usuario::PERFIL_EXTERNO || $user->role == \common\models\Usuario::PERFIL_TERCEIRO)
    //         {
    //             if ($configuracao)
    //                 $user->status = $configuracao->status_padrao_usuario;
    //             else
    //                 $user->status = 2;
    //         }
    //         $user->status = $status;

    //         if (count($configuracao) > 0)
    //         {
    //             $configuracao = $configuracao[0];
    //             $dominios = explode(',',str_replace(" ", "", $configuracao->dominios));
    //             $dominio_usuario = explode('@', $email)[1];
    //             // Se o domínio do e-mail do usuário for igual ao domínio da fundação, trata-se de um colaborador (se assim estiver configurado)
    //             if (in_array($dominio_usuario, $dominios) && $configuracao->definir_colaborador_automaticamente)
    //             {
    //                 $user->role = User::PERFIL_COLABORADOR;
    //             }
    //         }
            
    //         $response = $user->save() ? $user : null;
    //     }

    //     return $response;
    // }

    public function actionRecover()
    {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $email = $_POST['email'];
        $user = Usuario::findByUsername($email);
        
        if(!empty($user)) {

            // Aqui vamos enviar o e-mail coma senha...

            $response = [
              'status' => true,
              'message' => 'Senha enviada',
              'data' => [
                  'id' => $user->id,
              ]
            ];
        }
        else{
          $response = [
            'status' => false,
            'message' => 'Usuário não encontrado no banco de dados',
            'data' => print_r($_POST, true),
          ];
        }

        return $response;
    }

    public function actionSetRegistrationId ($id)
    {
      $_PUT = json_decode(file_get_contents('php://input'), true);
      $model = Usuario::findOne($id);

      if ($model)
      {
        $model->idFirebase = $_PUT['idFirebase'];
        if ($model->save())
          return ['status' => 1, 'message' => 'Usuário salvo com sucesso', 'data' => $_PUT['idFirebase']];
        else
          return ['status' => 0, 'message' => 'Erro ao salvar usuário', 'data' => $model->getErrors()];
      }
      else
        return ['status' => -1, 'message' => 'Usuário inexistente'];
    }
}
