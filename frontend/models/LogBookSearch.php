<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LogBook;

/**
 * LogBookSearch represents the model behind the search form about `frontend\models\LogBook`.
 */
class LogBookSearch extends LogBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'record_no'], 'integer'],
            [['student_reg_no', 'week_number', 'date_to', 'day', 'tasks_done'], 'safe'],
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
        $query = LogBook::find();

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
            'user_id' => Yii::$app->user->id,   //filter results according to currently logged in user         
            'date_to' => $this->date_to,
            'record_no' => $this->record_no,            
        ]);

        $query->andFilterWhere(['like', 'student_reg_no', $this->student_reg_no])
            ->andFilterWhere(['like', 'week_number', $this->week_number])
            ->andFilterWhere(['like', 'day', $this->day])
            ->andFilterWhere(['like', 'tasks_done', $this->tasks_done]);

        return $dataProvider;
    }
}
