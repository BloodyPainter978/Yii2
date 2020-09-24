<?php

namespace app\models\queries;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $lastname
 * @property string $firstname
 * @property string|null $patronymic
 * @property string|null $login
 * @property string|null $pass
 * @property string|null $token
 * @property int|null $expired_at
 * @property int $gender_id
 * @property string|null $birthday
 * @property int $active
 *
 * @property Teacher $teacher
 * @property Gender $gender
 * @property Student $user
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname', 'firstname', 'gender_id'], 'required'],
            [['expired_at', 'gender_id', 'active'], 'integer'],
            [['birthday'], 'safe'],
            [['lastname', 'firstname', 'patronymic', 'login'], 'string', 'max' => 50],
            [['pass', 'token'], 'string', 'max' => 255],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'gender_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'pass' => 'Pass',
            'token' => 'Token',
            'expired_at' => 'Expired At',
            'gender_id' => 'Gender ID',
            'birthday' => 'Birthday',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|TeacherQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['gender_id' => 'gender_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|StudentQuery
     */
    public function getUser()
    {
        return $this->hasMany(Student::className(), ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getGender()
    {
        return $this->hasOne(Gender::className(),['gender_id' =>
            'gender_id']);
    }

    public function validatePassword($password)
    {
	return Yii::$app->getSecurity()
		->validatePassword($password, $this->pass);
    }

    public function getId()
    {
	return $this->getPrimaryKey();
    }
    
    public static function findIdentity($id)
    {
	return static::findOne(['user_id' => $id, 'active' =>
	self::STATUS_ACTIVE]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
	return static::find()
		->andWhere(['token' => $token])
		->andWhere(['>', 'expired_at', time()])
		->one();
    }

    public static function findByUsername($username)
    {
	return static::findOne(['login' => $username, 'active'
	=> self::STATUS_ACTIVE]);
    }

    public function generateToken($expire)
    {
	$this->expired_at = $expire;
	$this->token = Yii::$app->security
		->generateRandomString();
    }

    public function tokenInfo( )
    {
	return [
	'token' => $this->token,
	'expiredAt' => $this->expired_at,
	'fio' => $this->lastname.' '.$this->firstname. '
	'.$this->patronymic,
	'roles' => Yii::$app->authManager->
	getRolesByUser($this->user_id)
	];
    }

    public function logout( )
    {
	$this->token = null;
	$this->expired_at = null;
	return $this->save();
    }

    public function getAuthKey( )
    {
	
    }

    public function validateAuthKey($authKey)
    {
	
    }

}
