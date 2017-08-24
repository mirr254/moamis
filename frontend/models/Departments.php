<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property string $department_name
 * @property integer $department_id
 * @property integer $school_id
 *
 * @property Schools $department
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_name', 'department_id', 'school_id'], 'required'],
            [['department_id', 'school_id'], 'integer'],
            [['department_name'], 'string', 'max' => 100],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Schools::className(), 'targetAttribute' => ['department_id' => 'school_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_name' => 'Department Name',
            'department_id' => 'Department ID',
            'school_id' => 'School ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Schools::className(), ['school_id' => 'department_id']);
    }
}
