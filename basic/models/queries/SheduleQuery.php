<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[Shedule]].
 *
 * @see Shedule
 */
class SheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Shedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
