<?php

namespace backend\api\models;

use Yii;

/**
 * This is the model class for table "schedules".
 *
 * @property int $id
 * @property string|null $day
 * @property int $userprofilesid
 *
 * @property Userprofile $userprofiles
 * @property Userschedulesregistry[] $userschedulesregistries
 */
class Schedules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day'], 'safe'],
            [['userprofilesid'], 'required'],
            [['userprofilesid'], 'integer'],
            [['userprofilesid'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::className(), 'targetAttribute' => ['userprofilesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Day',
            'userprofilesid' => 'Userprofilesid',
        ];
    }

    /**
     * Gets query for [[Userprofiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofiles()
    {
        return $this->hasOne(Userprofile::className(), ['id' => 'userprofilesid']);
    }

    /**
     * Gets query for [[Userschedulesregistries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserschedulesregistries()
    {
        return $this->hasMany(Userschedulesregistry::className(), ['schedulesid' => 'id']);
    }
}
