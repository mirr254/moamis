<?php

namespace frontend\models; 

use Yii;

/**
 * This is the model class for table "log_book".
 *
 * @property integer $user_id
 * @property string $student_reg_no
 * @property string $week_number
 * @property string $date_to
 * @property string $day
 * @property string $tasks_done
 * @property integer $record_no
 */
class LogBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'student_reg_no', 'week_number', 'date_to', 'day', 'tasks_done'], 'required'],
            [['user_id'], 'integer'],
            [['week_number', 'day'], 'string'],
            [['date_to'], 'safe'],
            [['date_to'], 'validatedate'],
            [['student_reg_no'], 'string', 'max' => 20],
            
        ];
    }

    /*
      Validate date not to pick past dates
    */
      public function validateDate()
      {
        if ( strtotime($this->date_to) < strtotime('NOW()')  ) {
            //error. date should be greater than today
            $this->addError('date_to','Date ending cannot be past');
        }
      }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'student_reg_no' => 'Student Reg No', 
            'week_number' => 'Week Number',            
            'date_to' => 'Week Ending ',
            'day' => 'Day',
            'tasks_done' => 'Tasks Done',
            'record_no' => 'Record No',            
        ];
    }
}
