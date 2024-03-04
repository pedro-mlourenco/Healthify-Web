<?php

namespace backend\api\models;

use Yii;

/**
 * This is the model class for table "userschedulesregistry".
 *
 * @property int $id
 * @property string|null $employee_entry
 * @property string|null $employee_exit
 * @property int $schedulesid
 *
 * @property Schedules $schedules
 */
class Userschedulesregistry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userschedulesregistry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_entry', 'employee_exit'], 'safe'],
            [['schedulesid'], 'required'],
            [['schedulesid'], 'integer'],
            [['schedulesid'], 'exist', 'skipOnError' => true, 'targetClass' => Schedules::className(), 'targetAttribute' => ['schedulesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_entry' => 'Employee Entry',
            'employee_exit' => 'Employee Exit',
            'schedulesid' => 'Schedulesid',
        ];
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasOne(Schedules::className(), ['id' => 'schedulesid']);
    }
}
