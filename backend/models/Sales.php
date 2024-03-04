<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property string $salesday
 * @property float $precototal
 * @property float|null $discount
 * @property float $paidamount
 * @property string $paymentmethod
 * @property string $paymentstate
 * @property int $userprofilesid
 *
 * @property SalesMeals[] $salesMeals
 * @property Userprofiles $userprofiles
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
            [['precototal', 'paidamount', 'paymentmethod', 'paymentstate', 'userprofilesid'], 'required'],
            [['precototal', 'discount', 'paidamount'], 'number'],
            [['paymentmethod'], 'string'],
            [['userprofilesid'], 'integer'],
            [['paymentstate'], 'string', 'max' => 11],
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
            'salesday' => 'Data',
            'precototal' => 'Preço Total',
            'discount' => 'Desconto',
            'paidamount' => 'Total Pago',
            'paymentmethod' => 'Método de Pagamento',
            'paymentstate' => 'Estado do Pagamento',
            'userprofilesid' => 'ID do Cliente',
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
        return $this->hasOne(Userprofiles::className(), ['id' => 'userprofilesid']);
    }
}
