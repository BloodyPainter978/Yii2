<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "day".
 *
 * @property int $day_id
 * @property string $name
 *
 * @property Shedule[] $shedules
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'day_id' => 'Day ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Shedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShedules()
    {
        return $this->hasMany(Shedule::className(), ['day_id' => 'day_id']);
    }

	public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['day_id' => 'day_id']);
    }
}
