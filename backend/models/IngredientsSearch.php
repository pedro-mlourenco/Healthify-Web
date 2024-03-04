<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ingredients;

/**
 * IngredientsSearch represents the model behind the search form of `app\models\Ingredients`.
 */
class IngredientsSearch extends Ingredients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
            [['sugar_g', 'calories', 'protein_g', 'carbohydrates_total_g', 'fat_saturated_g', 'fat_total_g', 'fiber_g', 'cholesterol_mg'], 'number'],
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
        $query = Ingredients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 10 ],
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
            'sugar_g' => $this->sugar_g,
            'calories' => $this->calories,
            'protein_g' => $this->protein_g,
            'carbohydrates_total_g' => $this->carbohydrates_total_g,
            'fat_saturated_g' => $this->fat_saturated_g,
            'fat_total_g' => $this->fat_total_g,
            'fiber_g' => $this->fiber_g,
            'cholesterol_mg' => $this->cholesterol_mg,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
