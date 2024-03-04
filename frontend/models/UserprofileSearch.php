<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Userprofile;

/**
 * UserprofileSearch represents the model behind the search form of `app\models\Userprofile`.
 */
class UserprofileSearch extends Userprofile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nif', 'cellphone', 'door', 'floor', 'userid'], 'integer'],
            [['name', 'street', 'city', 'nib'], 'safe'],
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
        $query = Userprofile::find();

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
            'nif' => $this->nif,
            'cellphone' => $this->cellphone,
            'door' => $this->door,
            'floor' => $this->floor,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'nib', $this->nib]);

        return $dataProvider;
    }
}
