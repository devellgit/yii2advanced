<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tb_user".
 *
 * @property integer $id
 * @property integer $perfil
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 * @property string $passwordHash
 * @property string $authKey
 * @property string $passwordResetToken
 * @property integer $status
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password;

    const PERFIL_SUPER_ADMIN = 10;
    const PERFIL_SECRETARIA = 20;
    const PERFIL_ATENDENTE = 30;
    const PERFIL_USUARIO = 40;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfil'], 'integer'],
            [['username'], 'unique'],
            [['firstName', 'lastName', 'username', 'password', 'passwordHash', 'passwordResetToken', 'status', 'medico'], 'safe'],
            [['authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'Nome',
            'perfil' => 'Perfil',
            'lastName' => 'Sobrenome',
            'username' => 'Login',
            'password' => 'Senha',
            'authKey' => 'Auth Key',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['authKey' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //echo Yii::$app->security->generatePasswordHash($password);
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    public function getNomePerfil()
    {
        $array_perfil = [10=>'Super Admin', 20 => 'Secretaria', 30=>'Atendente', 40=>'Usuário'];
        
        return($array_perfil[$this->perfil]);
    }

    public function getStatusName()
    {
        return ($this->status == 0)?'Inativo':'Ativo';
    }

    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idUsuario']);
    }

    public function getAtendente()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idAtendente']);
    }
}
