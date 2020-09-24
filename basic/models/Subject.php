<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $subject_id
 * @property string $name
 * @property int $otdel_id
 * @property int $hours
 * @property int $active
 *
 * @property LessonPlan[] $lessonPlans
 * @property Otdel $otdel
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'otdel_id', 'hours'], 'required'],
            [['otdel_id', 'hours', 'active'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['otdel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Otdel::className(), 'targetAttribute' => ['otdel_id' => 'otdel_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'name' => 'Name',
            'otdel_id' => 'Otdel ID',
            'hours' => 'Hours',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[LessonPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLessonPlans()
    {
        return $this->hasMany(LessonPlan::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * Gets query for [[Otdel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtdel()
    {
        return $this->hasOne(Otdel::className(), ['otdel_id' => 'otdel_id']);
    }
}
