<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider; 
use backend\models\Assessment;

/**
 * AssessmentSearch represents the model behind the search form about `backend\models\Assessment`.
 */
class AssessmentSearch extends Assessment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assessment_no', 'department_id', 'points_awarded'], 'integer'],
            [['student_reg_number', 'date_of_assessment', 'staff_id', 'comments'], 'safe'],
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
        $query = Assessment::find();

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
            'assessment_no' => $this->assessment_no,
            'department_id' => $this->department_id,
            'date_of_assessment' => $this->date_of_assessment,
            'points_awarded' => $this->points_awarded,
        ]);

        $query->andFilterWhere(['like', 'student_reg_number', $this->student_reg_number])
            ->andFilterWhere(['like', 'staff_id', Yii::$app->user->identity->username ])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
