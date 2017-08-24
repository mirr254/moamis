<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_details".
 *
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $department_id
 * @property integer $faculty_id
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
            [['username', 'email', 'password', 'department_id', 'faculty_id'], 'required'],
            [['department_id', 'faculty_id'], 'integer'],
            [['username', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'department_id' => 'Department ID',
            'faculty_id' => 'Faculty ID',
        ];
    }
}
