<?php

namespace app\models\queries;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $user_id
 * @property int $otdel_id
 *
 * @property LessonPlan[] $lessonPlans
 * @property User $user
 * @property Otdel $otdel
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'otdel_id'], 'required'],
            [['user_id', 'otdel_id'], 'integer'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['otdel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Otdel::className(), 'targetAttribute' => ['otdel_id' => 'otdel_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'otdel_id' => 'Otdel ID',
        ];
    }

    /**
     * Gets query for [[LessonPlans]].
     *
     * @return \yii\db\ActiveQuery|LessonPlanQuery
     */
    public function getLessonPlans()
    {
        return $this->hasMany(LessonPlan::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Otdel]].
     *
     * @return \yii\db\ActiveQuery|OtdelQuery
     */
    public function getOtdel()
    {
        return $this->hasOne(Otdel::className(), ['otdel_id' => 'otdel_id']);
    }

    /**
     * {@inheritdoc}
     * @return TeacherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeacherQuery(get_called_class());
    }
}
