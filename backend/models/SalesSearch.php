<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sales;

/**
 * SalesSearch represents the model behind the search form of `app\models\Sales`.
 */
class SalesSearch extends Sales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userprofilesid'], 'integer'],
            [['salesday', 'paymentmethod', 'paymentstate'], 'safe'],
            [['precototal', 'discount', 'paidamount'], 'number'],
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
        $query = Sales::find();

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
            'salesday' => $this->salesday,
            'precototal' => $this->precototal,
            'discount' => $this->discount,
            'paidamount' => $this->paidamount,
            'userprofilesid' => $this->userprofilesid,
        ]);

        $query->andFilterWhere(['like', 'paymentmethod', $this->paymentmethod])
            ->andFilterWhere(['like', 'paymentstate', $this->paymentstate]);

        return $dataProvider;
    }
}
