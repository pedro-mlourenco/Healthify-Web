<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MealIngredients;

/**
 * MealingredientsSearch represents the model behind the search form of `app\models\Mealingredients`.
 */
class MealIngredientsSearch extends MealIngredients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mealsid', 'ingredientsid'], 'integer'],
            [['serving_size_g', 'total_sugar_g', 'total_calories', 'total_protein_g', 'total_carbohydrates_total_g', 'total_fat_saturated_g', 'total_fat_total_g', 'total_fiber_g', 'total_cholesterol_mg'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mealingredients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'serving_size_g' => $this->serving_size_g,
            'total_sugar_g' => $this->total_sugar_g,
            'total_calories' => $this->total_calories,
            'total_protein_g' => $this->total_protein_g,
            'total_carbohydrates_total_g' => $this->total_carbohydrates_total_g,
            'total_fat_saturated_g' => $this->total_fat_saturated_g,
            'total_fat_total_g' => $this->total_fat_total_g,
            'total_fiber_g' => $this->total_fiber_g,
            'total_cholesterol_mg' => $this->total_cholesterol_mg,
            'mealsid' => $this->mealsid,
            'ingredientsid' => $this->ingredientsid,
        ]);

        return $dataProvider;
    }
}
