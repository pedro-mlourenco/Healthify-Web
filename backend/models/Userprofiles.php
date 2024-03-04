<?php

namespace app\models;

use app\api\models\Cart;
use backend\api\models\Schedules;
use common\models\User;
use Yii;

/**
 * This is the model class for table "userprofiles".
 *
 * @property int $id
 * @property int $nif
 * @property string $name
 * @property int $cellphone
 * @property string $street
 * @property int $door
 * @property int|null $floor
 * @property string $city
 * @property string|null $nib
 * @property int $userid
 *
 * @property Cart[] $carts
 * @property Reviews[] $reviews
 * @property Sales[] $sales
 * @property Schedules[] $schedules
 * @property User $user
 */
class Userprofiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'name', 'cellphone', 'street', 'door', 'city', 'userid'], 'required'],
            [['nif', 'cellphone', 'door', 'floor', 'userid'], 'integer'],
            [['name', 'street'], 'string', 'max' => 20],
            [['city'], 'string', 'max' => 15],
            [['nib'], 'string', 'max' => 25],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nif' => 'Nif',
            'name' => 'Name',
            'cellphone' => 'Cellphone',
            'street' => 'Street',
            'door' => 'Door',
            'floor' => 'Floor',
            'city' => 'City',
            'nib' => 'Nib',
            'userid' => 'Userid',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedules::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
