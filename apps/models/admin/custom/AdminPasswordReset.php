<?php

namespace adminModels;

use Yii;
use models\Admin;
use userModels\Otp;
use yii\base\Model;
use userModels\PasswordHistory;
use Psr\Log\InvalidArgumentException;

/**
 * @OA\Schema(
 *     schema="AdminPasswordReset",
 *     title="AdminPasswordReset ",
 * 
 *  @OA\Property(
 *     property="user_id",
 *     type="string",
 *   ),
 *  @OA\Property(
 *     property="password",
 *     type="string",
 *   ),
 * 
 *  @OA\Property(
 *     property="confirm_password",
 *     type="string",
 *   ),
 *
 * )
 */


/**
 * Password reset form
 */
class AdminPasswordReset extends Model
{
    public $password; 
    public $user_id;
    public $confirm_password;
    private $_user;

    

    /**
     * {@inheritdoc}
     */
   public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            ['password', 'string', 'min' => 8],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords do not match" ],
        ];
    }
    


}

