<?php

namespace adminModels;

use Yii;
use models\Admin;
use components\Sms;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


/**
 * @OA\Schema(
 *   schema="AdminVerifyNumber",
 *   type="object",
 *   required={"user_id", "OTP", "updated_at", "created_at"},
 *  
 * @OA\Property(
 *     property="user_id",
 *     type="integer",
 * ), 
 * 
 * @OA\Property(
 *     property="OTP",
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

class AdminVerifyNumber extends ActiveRecord
{
    public $mobile_number;
    public $mobile;

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
            [['user_id'], 'required'],
            [['OTP'], 'required', 'message' => 'Verification code is required.'],
            [['OTP'], 'string', 'length' => 6],
            ['OTP', 'validateOtp']
        ];
    }

    public function validateOtp($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $model = self::findOne(['user_id' => $this->user_id, 'OTP'  =>  $this->OTP]);            
            if (is_null($model)) {
                $this->addError($attribute, 'Invalid OTP provided.');
            } else {
                if ($model->status == 1) {
                    $this->addError($attribute, 'This OTP has been used.');
                } else {
                    $expiry = '10 minutes';
                    if (strtotime('+' . $expiry,  $model->created_at) < time()) {
                        $this->addError($attribute, 'The OTP provided has expired, please request a new OTP');
                    }
                }
            }
            
        }
        return "validation errors";
    }


    public function fields()
    {
        return ['user_id', 'OTP'];
    }

    public function verifyNumber()
    {
        $model = self::findOne(['user_id' => $this->user_id, 'OTP'  =>  $this->OTP]); 
        $x =  "admin password reset";
        $model->type = $x;          
        $model->status = true;
        if($model->save(false)){
            
                return [ 'status' => "Mobile verified"];
        }
    }
}
