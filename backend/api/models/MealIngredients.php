<?php

namespace app\api\models;

use Yii;

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
class MealIngredients extends \yii\db\ActiveRecord
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
            'serving_size_g' => 'Serving Size G',
            'total_sugar_g' => 'Total Sugar G',
            'total_calories' => 'Total Calories',
            'total_protein_g' => 'Total Protein G',
            'total_carbohydrates_total_g' => 'Total Carbohydrates Total G',
            'total_fat_saturated_g' => 'Total Fat Saturated G',
            'total_fat_total_g' => 'Total Fat Total G',
            'total_fiber_g' => 'Total Fiber G',
            'total_cholesterol_mg' => 'Total Cholesterol Mg',
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
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredientsid']);
    }

    /**
     * Gets query for [[Meals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeals()
    {
        return $this->hasOne(Meals::className(), ['id' => 'mealsid']);
    }
}
