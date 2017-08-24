<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "counties".
 *
 * @property integer $county_id
 * @property string $county_name
 */
class Counties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['county_name'], 'required'],
            [['county_name'], 'string', 'max' => 100],
            [['county_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'county_id' => 'County ID',
            'county_name' => 'County Name',
        ];
    }

    /*Relation*/

    public function getStaffDetails()
    {
        return $this->hasMany(StaffDetails::className(), ['staff_id' => 'county_id' ]);
    }
}
