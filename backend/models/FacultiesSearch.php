<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faculties;

/**
 * FacultiesSearch represents the model behind the search form about `backend\models\Faculties`.
 */
class FacultiesSearch extends Faculties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_name', 'faculty_initials'], 'safe'],
            [['faculty_id'], 'integer'],
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
        $query = Faculties::find();

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
            'faculty_id' => $this->faculty_id,
        ]);

        $query->andFilterWhere(['like', 'faculty_name', $this->faculty_name])
            ->andFilterWhere(['like', 'faculty_initials', $this->faculty_initials]);

        return $dataProvider;
    }
}
