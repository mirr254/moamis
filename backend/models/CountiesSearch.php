<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Counties;

/**
 * CountiesSearch represents the model behind the search form about `backend\models\Counties`.
 */
class CountiesSearch extends Counties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['county_id'], 'integer'],
            [['county_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Counties::find();

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
            'county_id' => $this->county_id,
        ]);

        $query->andFilterWhere(['like', 'county_name', $this->county_name]);

        return $dataProvider;
    }
}
