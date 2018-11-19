<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%Agendamento}}".
 *
 * @property integer $id
 * @property integer $idServico
 * @property integer $idAtendente
 * @property integer $idAtendenteExcluiu
 * @property integer $idLocal
 * @property string $data
 * @property integer $horario
 * @property integer $duracao
 * @property string $anotacao
 * @property string $dataHoraAgendamento
 * @property integer $status
 */
class Agendamento extends \yii\db\ActiveRecord
{
    public static $horarios = array(
        0=>'00:00',
        1=>'00:20',
        2=>'00:40',
        3=>'01:00',
        4=>'01:20',
        5=>'01:40',
        6=>'02:00',
        7=>'02:20',
        8=>'02:40',
        9=>'03:00',
        10=>'03:20',
        11=>'03:40',
        12=>'04:00',
        13=>'04:20',
        14=>'04:40',
        15=>'05:00',
        16=>'05:20',
        17=>'05:40',
        18=>'06:00',
        19=>'06:20',
        20=>'06:40',
        21=>'07:00',
        22=>'07:20',
        23=>'07:40',
        24=>'08:00',
        25=>'08:20',
        26=>'08:40',
        27=>'09:00',
        28=>'09:20',
        29=>'09:40',
        30=>'10:00',
        31=>'10:20',
        32=>'10:40',
        33=>'11:00',
        34=>'11:20',
        35=>'11:40',
        36=>'12:00',
        37=>'12:20',
        38=>'12:40',
        39=>'13:00',
        40=>'13:20',
        41=>'13:40',
        42=>'14:00',
        43=>'14:20',
        44=>'14:40',
        45=>'15:00',
        46=>'15:20',
        47=>'15:40',
        48=>'16:00',
        49=>'16:20',
        50=>'16:40',
        51=>'17:00',
        52=>'17:20',
        53=>'17:40',
        54=>'18:00',
        55=>'18:20',
        56=>'18:40',
        57=>'19:00',
        58=>'19:20',
        59=>'19:40',
        60=>'20:00',
        61=>'20:20',
        62=>'20:40',
        63=>'21:00',
        64=>'21:20',
        65=>'21:40',
        66=>'22:00',
        67=>'22:20',
        68=>'22:40',
        69=>'23:00',
        70=>'23:20',
        71=>'23:40',
    );

    const STATUS_ATIVO = 1;
    const STATUS_CANCELADO = 0;

    const LIMITE_POR_SLOT = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Agendamento}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAtendente', 'idLocal', 'idServico', 'data', 'horario', 'duracao'], 'required'],
            [['idLocal', 'idServico'], 'integer'],
            [['data','horario', 'duracao','status', 'idAtendenteExcluiu','dataHoraAgendamento'], 'safe'],
            [['anotacao'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idServico' => 'Serviço',
            'idAtendente' => 'Atendente',
            'idLocal' => 'Local',
            'data' => 'Data',
            'horario' => 'Horário',
            'duracao' => 'Duração (min)',
            'anotacao' => 'Anotação',
            'diagnostico' => 'Diagnóstico',
            'status' => 'Status',
        ];
    }

    public function getAtendente ()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idAtendente']);
    }
    
    public function getServico ()
    {
        return $this->hasOne(Servico::className(), ['id' => 'idServico']);
    }

    public function getLocal ()
    {
        return $this->hasOne(Local::className(), ['id' => 'idLocal']);
    }
}
