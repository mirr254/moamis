<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "student_attachment_details".
 *
 * @property integer $createdBy
 * @property string $reg_no
 * @property string $county_attached
 * @property string $closest_town
 * @property string $company_attached
 * @property integer $company_phone_number
 * @property string $is_assessed
 * @property string $location_description
 * @property integer $department_id
 * @property string $allocated_staff_id
 */
class StudentAttachmentDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_attachment_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdBy', 'reg_no', 'county_attached', 'closest_town', 'company_attached', 'company_phone_number', 'location_description', 'department_id'], 'required'],
            [['createdBy', 'company_phone_number', 'department_id'], 'integer'],
            [['county_attached', 'is_assessed', 'location_description'], 'string'],
            [['reg_no'], 'string', 'max' => 20],
            [['closest_town', 'company_attached'], 'string', 'max' => 100],
            [['allocated_staff_id'], 'string', 'max' => 200],
            [['createdBy'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'createdBy' => 'Created By',
            'reg_no' => 'Reg No',
            'county_attached' => 'County Attached',
            'closest_town' => 'Closest Town',
            'company_attached' => 'Company Attached',
            'company_phone_number' => 'Company contacts',
            'is_assessed' => 'Is Assessed',
            'location_description' => 'Location Description',
            'department_id' => 'Department ID',
            'allocated_staff_id' => 'Supervisor Id', //staff id of the supervisor
        ];
    }

         
     public static function getStudents($department_id){ 
         $data = StudentAttachmentDetails::find() 
                 ->where(['department_id'=>$department_id, 'is_assessed'=> 'no', 'allocated_staff_id' => Yii::$app->user->identity->username]) 
                 ->select(['reg_no As id','reg_no As name']) 
                 ->asArray() 
                 ->all(); 
         $value = (count($data) == 0) ? ['' => ''] : $data; 
   
         return $value; 
     } 
}
