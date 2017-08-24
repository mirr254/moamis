<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $department_id
 * @property string $department_name
 * @property integer $faculty_id
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_name', 'faculty_id'], 'required'],
            [['faculty_id'], 'integer'],
            [['department_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'faculty_id' => 'Faculty ID',
        ];
    }

    public static function getDepartment($faculty_id){
        $data = Department::find()
                ->where(['faculty_id'=>$faculty_id])
                ->select(['department_id As id','department_name As name'])
                ->asArray()
                ->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
}
