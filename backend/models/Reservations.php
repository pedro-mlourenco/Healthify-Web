<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property int $id
 * @property string $reservedday
 * @property string $reservedtime
 * @property int $userprofilesid
 * @property int $tableid
 *
 * @property Tables $table
 * @property User $userprofiles
 */
class Reservations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reservedday', 'reservedtime', 'userprofilesid', 'tableid'], 'required'],
            [['reservedday'], 'string'],
            [['reservedtime'], 'string'],
            [['userprofilesid', 'tableid'], 'integer'],
            [['tableid'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::className(), 'targetAttribute' => ['tableid' => 'id']],
            [['userprofilesid'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofiles::className(), 'targetAttribute' => ['userprofilesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID da Reserva',
            'reservedday' => 'Dia da Reserva',
            'reservedtime' => 'Horário Reservado',
            'userprofilesid' => 'ID do Cliente',
            'tableid' => 'Nº da mesa',
        ];
    }

    /**
     * Gets query for [[Table]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Tables::className(), ['id' => 'tableid']);
    }


    public static function getReservesTotalCount()
    {
        $reservations = Reservations::find()->andFilterCompare('reservedday', date("Y/m/d"), '>=')->all();


        $count = count($reservations);

        return $count;
    }

    public static function getReservesChartData()
    {
        $almoco = count(Reservations::find()->where(['reservedtime' => 'almoco'])->all());
        $jantar = count(Reservations::find()->where(['reservedtime' => 'jantar'])->all());

        $contagem = array($almoco, $jantar);

        return $contagem;
    }

    /**
     * Gets query for [[Userprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofiles()
    {
        return $this->hasOne(User::className(), ['id' => 'userprofilesid']);
    }
}
