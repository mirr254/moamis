<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "student_details".
 *
 * @property integer $user_id
 * @property string $reg_no
 * @property string $student_first_name
 * @property string $student_middle_name
 * @property string $student_last_name
 * @property string $course
 * @property string $year_of_study
 * @property string $current_semester
 * @property integer $phone_number
 * @property integer $faculty_id
 * @property integer $department_id
 * @property string $county_attached
 * @property string $closest_town
 * @property string $company_attached
 * @property string $location_description
 */
class StudentDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'reg_no', 'student_first_name', 'student_middle_name', 'student_last_name', 'course', 'year_of_study', 'current_semester', 'phone_number', 'faculty_id', 'department_id', 'county_attached', 'closest_town', 'company_attached', 'location_description'], 'required'],
            [['user_id', 'phone_number', 'faculty_id', 'department_id'], 'integer'],
            [['county_attached', 'location_description'], 'string'],
            [['reg_no', 'student_first_name', 'student_middle_name', 'student_last_name'], 'string', 'max' => 20],
            [['course'], 'string', 'max' => 50],
            [['year_of_study', 'current_semester'], 'string', 'max' => 5],
            [['closest_town', 'company_attached'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'reg_no' => 'Reg No',
            'student_first_name' => 'Student First Name',
            'student_middle_name' => 'Student Middle Name',
            'student_last_name' => 'Student Last Name',
            'course' => 'Course',
            'year_of_study' => 'Year Of Study',
            'current_semester' => 'Current Semester',
            'phone_number' => 'Phone Number',
            'faculty_id' => 'Faculty ID',
            'department_id' => 'Department ID',
            'county_attached' => 'County Attached',
            'closest_town' => 'Closest Town',
            'company_attached' => 'Company Attached',
            'location_description' => 'Location Description',
        ];
    }
}
