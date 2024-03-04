<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reservations;

/**
 * ReservationsSearch represents the model behind the search form of `app\models\Reservations`.
 */
class ReservationsSearch extends Reservations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userprofilesid', 'tableid'], 'integer'],
            [['reservedday', 'reservedtime'], 'safe'],
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
        $query = Reservations::find();

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
            'reservedday' => $this->reservedday,
            'reservedtime' => $this->reservedtime,
            'userprofilesid' => $this->userprofilesid,
            'tableid' => $this->tableid,
        ]);

        return $dataProvider;
    }
}
