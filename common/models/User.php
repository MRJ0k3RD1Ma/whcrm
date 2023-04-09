<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string|null $phone
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $role_id
 * @property int $status
 * @property string|null $auth_key
 * @property string|null $verification_token
 * @property string|null $password_reset_token
 *
 * @property Price[] $prices
 * @property Role $role
 * @property WareUser[] $wareUsers
 * @property Warehouse[] $wares
 * @property WhProduct[] $whProducts
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{


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
            [['name', 'username',], 'required'],
            [['password'],'required','on'=>'create'],
            [['created', 'updated'], 'safe'],
            ['username', 'match' ,'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Логин кичик лотин харфлари ва рақамлардан иборат боўлиши керак'],
            [['role_id', 'status'], 'integer'],
            [['name', 'username', 'phone'], 'string', 'max' => 255],
            [['password', 'auth_key', 'verification_token', 'password_reset_token'], 'string', 'max' => 500],
            [['username'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'FIO',
            'username' => 'Login',
            'password' => 'Parol',
            'phone' => 'Telefon',
            'created' => 'Yaratildi',
            'updated' => 'O`zgartirildi',
            'role_id' => 'Huquqi',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'verification_token' => 'Verification Token',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[WareUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWareUsers()
    {
        return $this->hasMany(WareUser::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Wares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWares()
    {
        return $this->hasMany(Warehouse::class, ['id' => 'ware_id'])->viaTable('ware_user', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[WhProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhProducts()
    {
        return $this->hasMany(WhProduct::class, ['user_id' => 'id']);
    }


    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;


    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
