<?php

namespace backend\models; 

use Yii;

/**
 * This is the model class for table "assessment".
 *
 * @property integer $assessment_no
 * @property string $student_reg_number
 * @property string $date_of_assessment
 * @property string $assesors_name
 * @property integer $points_awarded
 * @property string $comments
 */
class Assessment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assessment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_reg_number','date_of_assessment','staff_id', 'points_awarded', 'comments'], 'required'],
            [['department_id', 'points_awarded'], 'integer'],
            [['date_of_assessment'], 'safe'],
            [['comments'], 'string'],
            [['student_reg_number', 'staff_id'], 'string', 'max' => 100],
            [['student_reg_number'], 'unique'],
            [['points_awarded'], 'validatepoints'],
        ];
    }

    /*
    Points should not be greater than 100
    */
    public function validatePoints()
    {
        if ( $this->points_awarded > 100 ) {
            $this->addError('points_awarded', 'Marks should be less than a hundred');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'assessment_no' => 'Assessment No',
            'student_reg_number' => 'Student Reg Number',                   
            'department_id' => 'Department ID',
            'date_of_assessment' => 'Date Of Assessment',
            'staff_id' => 'Assesors staff ID',
            'points_awarded' => 'Points Awarded',
            'comments' => 'Comments',
        ];
    }
}
