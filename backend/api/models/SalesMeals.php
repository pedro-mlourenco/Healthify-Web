<?php

namespace backend\api\models;

use app\api\models\Meals;
use Yii;

/**
 * This is the model class for table "sales_meals".
 *
 * @property int $id
 * @property int $salesid
 * @property int $mealid
 * @property float $sellingprice
 * @property int $itemquantity
 * @property string|null $state
 * @property string|null $mesa
 *
 * @property Meals $meal
 * @property Sales $sales
 */
class SalesMeals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_meals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salesid', 'mealid', 'sellingprice', 'itemquantity'], 'required'],
            [['salesid', 'mealid', 'itemquantity'], 'integer'],
            [['sellingprice'], 'number'],
            [['state', 'mesa'], 'string', 'max' => 11],
            [['mealid'], 'exist', 'skipOnError' => true, 'targetClass' => Meals::className(), 'targetAttribute' => ['mealid' => 'id']],
            [['salesid'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['salesid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salesid' => 'Salesid',
            'mealid' => 'Mealid',
            'sellingprice' => 'Sellingprice',
            'itemquantity' => 'Itemquantity',
            'state' => 'State',
            'mesa' => 'Mesa',
        ];
    }

    /**
     * Gets query for [[Meal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(Meals::className(), ['id' => 'mealid']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['id' => 'salesid']);
    }
}