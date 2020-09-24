<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "shedule".
 *
 * @property int $shedule_id
 * @property int $lesson_plan_id
 * @property int $day_id
 * @property int $lesson_num_id
 * @property int $classroom_id
 *
 * @property LessonPlan $lessonPlan
 * @property LessonNum $lessonNum
 * @property Day $day
 * @property Classroom $classroom
 */
class Shedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_plan_id', 'day_id', 'lesson_num_id', 'classroom_id'], 'required'],
            [['lesson_plan_id', 'day_id', 'lesson_num_id', 'classroom_id'], 'integer'],
            [['lesson_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => LessonPlan::className(), 'targetAttribute' => ['lesson_plan_id' => 'lesson_plan_id']],
            [['lesson_num_id'], 'exist', 'skipOnError' => true, 'targetClass' => LessonNum::className(), 'targetAttribute' => ['lesson_num_id' => 'lesson_num_id']],
            [['day_id'], 'exist', 'skipOnError' => true, 'targetClass' => Day::className(), 'targetAttribute' => ['day_id' => 'day_id']],
            [['classroom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classroom::className(), 'targetAttribute' => ['classroom_id' => 'classroom_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'shedule_id' => 'Shedule ID',
            'lesson_plan_id' => 'Lesson Plan ID',
            'day_id' => 'Day ID',
            'lesson_num_id' => 'Lesson Num ID',
            'classroom_id' => 'Classroom ID',
        ];
    }

    /**
     * Gets query for [[LessonPlan]].
     *
     * @return \yii\db\ActiveQuery|LessonPlanQuery
     */
    public function getLessonPlan()
    {
        return $this->hasOne(LessonPlan::className(), ['lesson_plan_id' => 'lesson_plan_id']);
    }

    /**
     * Gets query for [[LessonNum]].
     *
     * @return \yii\db\ActiveQuery|LessonNumQuery
     */
    public function getLessonNum()
    {
        return $this->hasOne(LessonNum::className(), ['lesson_num_id' => 'lesson_num_id']);
    }

    /**
     * Gets query for [[Day]].
     *
     * @return \yii\db\ActiveQuery|DayQuery
     */
    public function getDay()
    {
        return $this->hasOne(Day::className(), ['day_id' => 'day_id']);
    }

    /**
     * Gets query for [[Classroom]].
     *
     * @return \yii\db\ActiveQuery|ClassroomQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['classroom_id' => 'classroom_id']);
    }

    /**
     * {@inheritdoc}
     * @return SheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SheduleQuery(get_called_class());
    }
}
