<?php

namespace models;

use Yii;
use components\UserJwt;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $mobile
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */

/**
 * @OA\Schema(
 *     schema="User",
 *     title="User ",
 * 
 *  @OA\Property(
 *     property="Username",
 *     type="string",
 *   ),
 *  @OA\Property(
 *     property="mobile",
 *     type="string",
 *   ),
 * 
 *  @OA\Property(
 *     property="password_hash",
 *     type="string",
 *   ),
 * 
 *  @OA\Property(
 *     property="password_reset_token",
 *     type="string",
 *   ),
 * 
 *  @OA\Property(
 *     property="auth_key",
 *     type="string",
 *   ),
 * 
 *  @OA\Property(
 *     property="status",
 *     format="int32",
 *     type="integer",
 *     description="status",
 *   ),
 * 
 *  @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="datetime",
 *   ),
 * 
 *  @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="datetime",
 *    ),
 * )
 */

class User extends ActiveRecord implements IdentityInterface
{
    //const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public $token;


    use UserJwt;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    // public function fields()
    // {
    //     return ['user_id'=>function(){
    //         return $this->id;
    //     }, 'phone number'=>function(){ 
    //         return $this->mobile; }, 'token'];
    // }

    public function fields()
    {
        return ['username','mobile', 'token', 'updated_at', 'created_at'];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return null or static
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->select('id, username, mobile, password_hash, auth_key, created_at, updated_at')
            // ->where(['status' => self::STATUS_ACTIVE])
            ->andWhere(['OR', ['username' => $username], ['mobile' => $username]])
            ->one();
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
        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->token = $this->getJWT();

        /* change format date */
        $parse = Yii::$app->formatter;
        $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
        $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->token = $this->getJWT();

        /* change format date */
        $parse = Yii::$app->formatter;
        $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
        $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
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
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
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
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}