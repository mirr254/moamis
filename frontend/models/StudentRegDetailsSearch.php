<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StudentRegDetails;

/**
 * StudentRegDetailsSearch represents the model behind the search form about `frontend\models\StudentRegDetails`.
 */
class StudentRegDetailsSearch extends StudentRegDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'department_id', 'phone_number'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'reg_no', 'year_of_study', 'current_semester', 'course', 'email'], 'safe'],
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
        $query = StudentRegDetails::find();

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
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
            'phone_number' => $this->phone_number,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'reg_no', $this->reg_no])
            ->andFilterWhere(['like', 'year_of_study', $this->year_of_study])
            ->andFilterWhere(['like', 'current_semester', $this->current_semester])
            ->andFilterWhere(['like', 'course', $this->course])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
