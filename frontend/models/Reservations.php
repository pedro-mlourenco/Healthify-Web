<?php

namespace app\models;

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
 * @property Userprofiles $userprofiles
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
            ['reservedtime', 'in', 'range' => ['almoco', 'jantar']],
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
            'id' => 'ID',
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

    /**
     * Gets query for [[Userprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofiles()
    {
        return $this->hasOne(Userprofiles::className(), ['id' => 'userprofilesid']);
    }
}