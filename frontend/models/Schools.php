<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schools".
 *
 * @property string $school_name
 * @property integer $school_id
 *
 * @property Departments $departments
 */
class Schools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_name', 'school_id'], 'required'],
            [['school_id'], 'integer'],
            [['school_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'school_name' => 'School Name',
            'school_id' => 'School ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'school_id']);
    }
}
