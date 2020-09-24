<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "lesson_plan".
 *
 * @property int $lesson_plan_id
 * @property int $gruppa_id
 * @property int $subject_id
 * @property int $user_id
 *
 * @property Subject $subject
 * @property Gruppa $gruppa
 * @property Teacher $user
 * @property Shedule[] $shedules
 */
class LessonPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gruppa_id', 'subject_id', 'user_id'], 'required'],
            [['gruppa_id', 'subject_id', 'user_id'], 'integer'],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
            [['gruppa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gruppa::className(), 'targetAttribute' => ['gruppa_id' => 'gruppa_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_plan_id' => 'Lesson Plan ID',
            'gruppa_id' => 'Gruppa ID',
            'subject_id' => 'Subject ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * Gets query for [[Gruppa]].
     *
     * @return \yii\db\ActiveQuery|GruppaQuery
     */
    public function getGruppa()
    {
        return $this->hasOne(Gruppa::className(), ['gruppa_id' => 'gruppa_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|TeacherQuery
     */
    public function getUser()
    {
        return $this->hasOne(Teacher::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Shedules]].
     *
     * @return \yii\db\ActiveQuery|SheduleQuery
     */
    public function getShedules()
    {
        return $this->hasMany(Shedule::className(), ['lesson_plan_id' => 'lesson_plan_id']);
    }

    /**
     * {@inheritdoc}
     * @return LessonPlanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonPlanQuery(get_called_class());
    }
}
