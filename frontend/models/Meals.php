<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meals".
 *
 * @property int $id
 * @property string $name
 * @property float $totalcalories
 * @property float $totalproteins
 * @property float $totalcarbohidrates
 * @property float $totalfats
 * @property float $totalfibers
 * @property float $price
 * @property string|null $description
 * @property string $category
 *
 * @property CartMeals[] $cartMeals
 * @property MealIngredients[] $meal-ingredients
 * @property SalesMeals[] $salesMeals
 */
class Meals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'totalcalories', 'totalproteins', 'totalcarbohidrates', 'totalfats', 'totalfibers', 'price', 'category'], 'required'],
            [['totalcalories', 'totalproteins', 'totalcarbohidrates', 'totalfats', 'totalfibers', 'price'], 'number'],
            [['category'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'totalcalories' => 'Totalcalories',
            'totalproteins' => 'Totalproteins',
            'totalcarbohidrates' => 'Totalcarbohidrates',
            'totalfats' => 'Totalfats',
            'totalfibers' => 'Totalfibers',
            'price' => 'Price',
            'description' => 'Description',
            'category' => 'Category',
        ];
    }

    /**
     * Gets query for [[CartMeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartMeals()
    {
        return $this->hasMany(CartMeals::className(), ['mealsid' => 'id']);
    }

    /**
     * Gets query for [[MealIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMealIngredients()
    {
        return $this->hasMany(MealIngredients::className(), ['mealsid' => 'id']);
    }

    /**
     * Gets query for [[SalesMeals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesMeals()
    {
        return $this->hasMany(SalesMeals::className(), ['mealid' => 'id']);
    }

}
