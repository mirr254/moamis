<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StudentAttachmentDetails;

/**
 * StudentAttachmentDetailsSearch represents the model behind the search form about `frontend\models\StudentAttachmentDetails`.
 */
class StudentAttachmentDetailsSearch extends StudentAttachmentDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdBy', 'company_phone_number', 'department_id'], 'integer'],
            [['reg_no', 'county_attached', 'closest_town', 'company_attached', 'is_assessed', 'location_description', 'allocated_staff_id'], 'safe'],
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
        $query = StudentAttachmentDetails::find();

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

           $retVal = (Yii::$app->user->can('permision_admin') == true ) ? $this->createdBy : Yii::$app->user->id ;
        // grid filtering conditions
        $query->andFilterWhere([
            'createdBy' => $retVal,
            'company_phone_number' => $this->company_phone_number,
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'reg_no', $this->reg_no])
            ->andFilterWhere(['like', 'county_attached', $this->county_attached])
            ->andFilterWhere(['like', 'closest_town', $this->closest_town])
            ->andFilterWhere(['like', 'company_attached', $this->company_attached])
            ->andFilterWhere(['like', 'is_assessed', $this->is_assessed])
            ->andFilterWhere(['like', 'location_description', $this->location_description])
            ->andFilterWhere(['like', 'allocated_staff_id', $this->allocated_staff_id]);

        return $dataProvider;
    }
}
