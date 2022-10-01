<?php

namespace models;

use Yii;
use models\User;
use components\Sms;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidArgumentException;

class Otp extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $mobile_number;

    /**
     * @OA\Schema(
     *   schema="sendOtp",
     *   type="object",
     *   title="sendOtp",
     *   required={"token", "updated_at", "created_at"},
     *  
     * 
     * @OA\Property(
     *     property="token",
     *     type="string",
     * ),
     * 
     * @OA\Property(
     *     property="updated_at",
     *     type="string",
     *     format="datetime",
     *   ),
     * 
     *    @OA\Property(
     *     property="created_at",
     *     type="string",
     *     format="datetime",
     *   ),
     *)
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['token', 'user_id'], 'required'],
            [['token'], 'string', 'length' => 6]


        ];
    }
    public static function sendToken($id)
    {
        $model = new self;
        $model->user_id = $id;
        $user = User::findOne(['id' => $id]);
        if ($user) {
            $model->mobile_number = '+254' . substr($user->mobile, -9);
            $otp =  str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);

            $model->token = $otp;

            if ($model->save()) {
                return Sms::sendOtp([
                    'to' => $model->mobile_number,
                    'msg' => $model->token
                ]);
            }
        } else {
            return false;
        }
    }

   
    public static function findByToken($token) {
        return static::findOne([
            'token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * verifying the validity of the provided otp
     * 
     */
    


}
