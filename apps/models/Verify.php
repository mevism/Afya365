<?php

namespace models;

use Yii;
use models\Post;
use models\User;
use components\Sms;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidArgumentException;

class Verify extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $token;


    /**
     * @OA\Schema(
     *   schema="Otp",
     *   type="object",
     *   title="Otp",
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

   

    /**
     * Verify email
     *
     * @return User|null the saved model or null if saving fails
     */
    public  function verify()
    {
        $model = new Verify();
        $isOtpValid = $model->token;
        $otp =  $this->token;
        if($otp = $isOtpValid){
            return true;
        }
        return false;

    }


}
