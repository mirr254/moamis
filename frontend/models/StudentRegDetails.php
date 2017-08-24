<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "student_reg_details".
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $department_id
 * @property string $reg_no
 * @property integer $phone_number
 * @property string $year_of_study
 * @property string $current_semester
 * @property string $course
 * @property string $email
 */
class StudentRegDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_reg_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name', 'department_id', 'reg_no', 'phone_number', 'year_of_study', 'current_semester', 'course', 'email'], 'required'],
            [['department_id', 'phone_number'], 'integer'],
            [['year_of_study', 'current_semester'], 'string'],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 20],
            [['reg_no', 'course', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'department_id' => 'Department ID',
            'reg_no' => 'Reg No',
            'phone_number' => 'Phone Number',
            'year_of_study' => 'Year Of Study',
            'current_semester' => 'Current Semester',
            'course' => 'Course',
            'email' => 'Email',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) { 
            return null;
        }
        
        $user = new User();
        $user->username = $this->reg_no;        
        $user->email = $this->email;
        $user->setPassword($this->email); //set email of the newly registered user to be the default password
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    
}
