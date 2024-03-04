<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $name
 * @property float $sugar_g
 * @property float $calories
 * @property float $protein_g
 * @property float $carbohydrates_total_g
 * @property float $fat_saturated_g
 * @property float $fat_total_g
 * @property float $fiber_g
 * @property float $cholesterol_mg
 *
 * @property MealIngredients[] $mealIngredients
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sugar_g', 'calories', 'protein_g', 'carbohydrates_total_g', 'fat_saturated_g', 'fat_total_g', 'fiber_g', 'cholesterol_mg'], 'required'],
            [['sugar_g', 'calories', 'protein_g', 'carbohydrates_total_g', 'fat_saturated_g', 'fat_total_g', 'fiber_g', 'cholesterol_mg'], 'number'],
            [['name'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'sugar_g' => 'Açucares',
            'calories' => 'Calorias',
            'protein_g' => 'Proteínas',
            'carbohydrates_total_g' => 'Hidratos de carbono',
            'fat_saturated_g' => 'Lípidos (saturados)',
            'fat_total_g' => 'Lípidos',
            'fiber_g' => 'Fibras',
            'cholesterol_mg' => 'Colesterol (mg)',
        ];
    }

    /**
     * Gets query for [[MealIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMealIngredients()
    {
        return $this->hasMany(MealIngredients::className(), ['ingredientsid' => 'id']);
    }

    public static function nameByID($id){

        $names = Ingredients::find()->where(['id'=>$id])->all();

        foreach ($names as $category) {
            $categoryNamesArray[] = $category['name'];
        }

        return $categoryNamesArray[0];
    }

}
