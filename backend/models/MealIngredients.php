<?php

namespace backend\models;

use app\models\Meals;
use Yii;

include_once 'Meals.php';

/**
 * This is the model class for table "meal_ingredients".
 *
 * @property int $id
 * @property float|null $serving_size_g
 * @property float $total_sugar_g
 * @property float $total_calories
 * @property float $total_protein_g
 * @property float $total_carbohydrates_total_g
 * @property float $total_fat_saturated_g
 * @property float $total_fat_total_g
 * @property float $total_fiber_g
 * @property float $total_cholesterol_mg
 * @property int $mealsid
 * @property int $ingredientsid
 *
 * @property Ingredients $ingredients
 * @property Meals $meals
 */
class Mealingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meal_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serving_size_g', 'total_sugar_g', 'total_calories', 'total_protein_g', 'total_carbohydrates_total_g', 'total_fat_saturated_g', 'total_fat_total_g', 'total_fiber_g', 'total_cholesterol_mg'], 'number'],
            [['total_sugar_g', 'total_calories', 'total_protein_g', 'total_carbohydrates_total_g', 'total_fat_saturated_g', 'total_fat_total_g', 'total_fiber_g', 'total_cholesterol_mg', 'mealsid', 'ingredientsid'], 'required'],
            [['mealsid', 'ingredientsid'], 'integer'],
            [['ingredientsid'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredientsid' => 'id']],
            [['mealsid'], 'exist', 'skipOnError' => true, 'targetClass' => Meals::className(), 'targetAttribute' => ['mealsid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serving_size_g' => 'Porção (g)',
            'total_sugar_g' => 'Açucares',
            'total_calories' => 'Total Calorias',
            'total_protein_g' => 'Total Proteínas',
            'total_carbohydrates_total_g' => 'Total Hidratos de carbono',
            'total_fat_saturated_g' => 'Total Lípidos (saturados)',
            'total_fat_total_g' => 'Total Lípidos',
            'total_fiber_g' => 'Total Fibra',
            'total_cholesterol_mg' => 'Total Colesterol (mg)',
            'mealsid' => 'Mealsid',
            'ingredientsid' => 'Ingredientsid',
        ];
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::className(), ['id' => 'ingredientsid']);
    }

    /**
     * Gets query for [[Meals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeals()
    {
        return $this->hasMany(Meals::className(), ['id' => 'mealsid']);
    }
}
