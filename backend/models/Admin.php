<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $admin_name
 * @property integer $id
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_name'], 'required'],
            [['admin_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_name' => 'Admin Name',
            'id' => 'ID',
        ];
    }
}
