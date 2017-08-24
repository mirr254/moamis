<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property string $faculty_name
 * @property integer $faculty_id
 * @property string $faculty_initials
 *
 * @property Departments $departments
 */
class Faculties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_name', 'faculty_initials'], 'required'],
            [['faculty_name'], 'string', 'max' => 100],
            [['faculty_initials'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faculty_name' => 'Faculty Name',
            'faculty_id' => 'Faculty ID',
            'faculty_initials' => 'Faculty Initials',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'faculty_id']);
    }
}
