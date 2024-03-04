<?php

namespace app\api\models;

use app\models\Category;
use backend\api\models\Reviews;
use backend\api\models\SalesMeals;
use Yii;

/**
 * This is the model class for table "meals".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string|null $description
 * @property int $categoryid
 *
 * @property Cart[] $carts
 * @property Category $category
 * @property MealIngredients[] $mealIngredients
 * @property Reviews[] $reviews
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
            [['name', 'price', 'categoryid'], 'required'],
            [['price'], 'number'],
            [['categoryid'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 100],
            [['categoryid'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryid' => 'id']],
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
            'price' => 'Price',
            'description' => 'Description',
            'categoryid' => 'Categoryid',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['mealsid' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryid']);
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
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['mealsid' => 'id']);
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
