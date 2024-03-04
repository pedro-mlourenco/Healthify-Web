<?php

namespace app\models;

use backend\api\models\SalesMeals;
use backend\models\Mealingredients;
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
 * @property Category $category
 * @property MealIngredients[] $mealIngredients
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
            'name' => 'Nome',
            'price' => 'Preço',
            'description' => 'Descrição',
            'categoryid' => 'ID da Categoria',
        ];
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

    public static function countItemsByCategory(){

        $ids = Category::getCategoryIDArray();//retorna todos os ids de categoria


        foreach ($ids as $id){
            $array[] = Meals::find()->where(['categoryid'=>$id])->count();
        }

        return $array;
    }

    public static function nameByID($id){

        $names = Meals::find()->where(['id'=>$id])->all();

        foreach ($names as $category) {
            $categoryNamesArray[] = $category['name'];
        }

        return $categoryNamesArray[0];
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
