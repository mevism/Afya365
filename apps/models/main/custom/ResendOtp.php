<?php

namespace userModels;

use Yii;
use models\User;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @OA\Schema(
 *   schema="Resend",
 *   type="object",
 *   required={ "user_id", "updated_at", "created_at"},
 *  
 *  @OA\Property(
 *     property="user_id",
 *     type="integer",
 * ),
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
class ResendOtp extends ActiveRecord
{

    public  $mobile_number;

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
            [
                'user_id', 'exist',
                'targetClass' => 'models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'targetAttribute'=> 'id',
                'message' => 'user does not exist.'
            ],
        ];
    }

    public function fields()
    {
        return ['user_id','created_at'];
    }

   
}
