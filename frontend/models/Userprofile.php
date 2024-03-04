<?php

namespace frontend\models;

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
 * @property string|null $floor
 * @property string $city
 * @property string|null $nib
 * @property int $userid
 *
 * @property Cart[] $carts
 * @property Review[] $reviews
 * @property Sale[] $sales
 * @property Schedule[] $schedules
 * @property User $user
 */
class Userprofile extends \yii\db\ActiveRecord
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
            [['door', 'userid'], 'integer'],
            [['name', 'street'], 'string', 'max' => 80],
            [['floor'],'string', 'max' => 20],
            [['city'], 'string', 'max' => 50],
            [['nib'], 'string', 'max' => 25],
            [['nif', 'cellphone'], 'number', 'min' => 111111111, 'max' => 999999999, 'tooBig' => 'O número deve ter exatamente 9 dígitos', 'tooSmall' => 'O número deve ter exatamente 9 dígitos'],
            [['street'], 'string', 'max' => 50],
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
            'nif' => 'NIF',
            'name' => 'Nome',
            'cellphone' => 'Nº Telemóvel',
            'street' => 'Rua',
            'door' => 'Nº Porta',
            'floor' => 'Andar',
            'city' => 'Cidade',
            'nib' => 'NIB',
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
        return $this->hasMany(Review::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::className(), ['userprofilesid' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['userprofilesid' => 'id']);
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

    public static function getNameWithID($id)
    {
        $client = Userprofile::find()->where(['id'=>$id])->select('name')->all();

        foreach ($client as $info){
            $name = $info->getAttribute('name');
        }

        return $name;
    }
}
