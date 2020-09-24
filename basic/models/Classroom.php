<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "classroom".
 *
 * @property int $classroom_id
 * @property int $name
 * @property int $active
 *
 * @property Shedule[] $shedules
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'classroom_id' => 'Classroom ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Shedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShedules()
    {
        return $this->hasMany(Shedule::className(), ['classroom_id' => 'classroom_id']);
    }

	public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['classroom_id' => 'classroom_id']);
    }
}
