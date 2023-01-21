<?php

namespace adminModels;

use Yii;
use components\DoctorJwt;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
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


class Doctor extends ActiveRecord 
{
    // use DoctorJwt;
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
        return 'doctor';
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
            [['doctor_details_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoctorDetails::class, 'targetAttribute' => ['doctor_details_id' => 'id']],

        ];

    }      

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    // public static function findByUsername($username)
    // {
    //     return static::find()
    //         ->select('id,  auth_key, created_at, updated_at')
    //         ->andWhere(['OR', ['first_name' => $username], ['staff_number' => $username]])
    //         ->one();
    // }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function fields()
    {
        return ['id', 'token'];
    }

    // public function afterFind()
    // {
    //     parent::afterFind();
    //     $this->token = $this->getJWT();

    //     /* change format date */
    //     $parse = Yii::$app->formatter;
    //     $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
    //     $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    // }


    // public function afterSave($insert, $changedAttributes)
    // {
    //     parent::afterSave($insert, $changedAttributes);
    //     $this->token = $this->getJWT();

    //     /* change format date */
    //     $parse = Yii::$app->formatter;
    //     $this->created_at = $parse->asDate($this->created_at, 'php:Y-m-d H:i:s');
    //     $this->updated_at = $parse->asDate($this->updated_at, 'php:Y-m-d H:i:s');
    // }

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


    public function validatePassword($id_number)
    {
        return Yii::$app->security->validatePassword($id_number, $this->password_hash);
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
}
