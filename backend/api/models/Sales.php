<?php

namespace backend\api\models;

use Yii;
use backend\api\models\Userprofile;
/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property string|null $salesday
 * @property float $precototal
 * @property float|null $discount
 * @property float|null $paidamount
 * @property string|null $paymentmethod
 * @property string $paymentstate
 * @property int $userprofilesid
 *
 * @property SalesMeals[] $salesMeals
 * @property Userprofile $userprofile
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salesday'], 'safe'],
            [['precototal', 'paymentstate', 'userprofilesid'], 'required'],
            [['precototal', 'discount', 'paidamount'], 'number'],
            [['paymentmethod'], 'string'],
            [['userprofilesid'], 'integer'],
            [['paymentstate'], 'string', 'max' => 11],
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
            'salesday' => 'Salesday',
            'precototal' => 'Precototal',
            'discount' => 'Discount',
            'paidamount' => 'Paidamount',
            'paymentmethod' => 'Paymentmethod',
            'paymentstate' => 'Paymentstate',
            'userprofilesid' => 'Userprofilesid',
        ];
    }

    /**
     * Gets query for [[SalesMeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesMeals()
    {
        return $this->hasMany(SalesMeals::className(), ['salesid' => 'id']);
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
}
