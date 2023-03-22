<?php

namespace models;

use Yii;
use yii\db\ActiveRecord;
use components\DoctorJwt;
use adminModels\DoctorDetails;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "doctor".
 *
 * @property int $id
 * @property string|null $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Appointment[] $appointments
 * @property Doctorschedule[] $doctorschedules
 * @property Users $user
 */

 /**
 * @OA\Schema(
 *     schema="Doc",
 *     title="Doc ",
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



class Doctor extends ActiveRecord implements IdentityInterface
{
    use DoctorJwt;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $token;
    public $password;
    // public $id_number;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%doctor}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE]],
        ];

    }      

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByUsername($username)
    {
        return static::find()
            ->select('id,username, auth_key,password_hash, created_at, updated_at')
            ->where(['OR', ['username' => $username]])
            ->one();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function fields()
    {
        return ['id','username', 'token'];
    }

    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->token = $this->getJWT();

        /* change format date */
        $parse = Yii::$app->formatter;
        $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
        $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->token = $this->getJWT();

        /* change format date */
        $parse = Yii::$app->formatter;
        $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
        $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    }



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


    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
 

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        
    }





    /**
     * Gets query for [[Appointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointments()
    {
        return $this->hasMany(Appointment::class, ['doctor_id' => 'id']);
    }

    /**
     * Gets query for [[Doctorschedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorschedules()
    {
        return $this->hasMany(Doctorschedule::class, ['doctor_id' => 'id']);
    }

    // /**
    //  * Gets query for [[User]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getUser()
    // {
    //     return $this->hasOne(Users::class, ['id' => 'user_id']);
    // }

    // public function details($id)
    // {
    //     return  DoctorDetails::find()
    //     ->select('id, first_name,  middle_name, last_name, email, date_of_birth, gender')
    //     ->where(['doctor_details_id' => $id])->asArray()
    //     ->one();
        
    // }
}
