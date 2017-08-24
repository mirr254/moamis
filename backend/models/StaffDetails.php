<?php

namespace backend\models;

use Yii;
use common\models\User;
use frontend\models\StudentAttachmentDetails;

/**
 * This is the model class for table "staff_details".
 *
 * @property integer $user_id
 * @property string $staff_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $department_id
 * @property string $email
 * @property integer $phone_number
 * @property integer $county_id
 * @property integer $no_of_students_allocated
 */
class StaffDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id', 'first_name', 'middle_name', 'last_name', 'department_id', 'email', 'phone_number', 'county_id'], 'required'],
            [['department_id', 'phone_number', 'county_id', 'no_of_students_allocated'], 'integer'],
            [['staff_id', 'email'], 'string', 'max' => 100],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 50],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\StaffDetails', 'message' => 'This email address has already been taken.'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'staff_id' => 'Staff ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'department_id' => 'Department ID',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'county_id' => 'County ID',
            'no_of_students_allocated' => 'No Of Students Allocated',
        ];
    }

    /**
     * Signs staff user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) { 
            return null;
        }
        
        $user = new User();
        $user->username = $this->staff_id;
        $user->email = $this->email;
        $user->setPassword($this->email);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    /*Relation with county. one staff per county*/

    public function getCounties()
    {
        return $this->hasOne( Counties::className(), ['staff_id'=>'county_id']);
    }

     public function getStudentAttachmentDetails() 
           { 
               return $this->hasMany(StudentAttachmentDetails::className(), ['staff_id' => 'allocated_staff_id']); 
           } 
}
