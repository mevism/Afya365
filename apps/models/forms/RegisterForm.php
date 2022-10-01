<?php

namespace forms;

use Yii;
use models\User;
use yii\base\Model;

/**
 * @OA\Schema(
 *   schema="NewUser",
 *   title="NewUser",
 *   type="object",
 *   required={ "username", "mobile", "confirm_mobile", "password","confirm_Password"},
 *
 *  @OA\Property(
 *     property="username",
 *     type="string",
 * ),
 * @OA\Property(
 *     property="mobile",
 *     type="string",
 * ),
 * @OA\Property(
 *     property="confirm_mobile",
 *     type="string",
 * ),
 * 
 * @OA\Property(
 *     property="password",
 *     type="string",
 * ),
 * @OA\Property(
 *     property="confirm_password",
 *     type="string",
 * ),
 *)
 */
class RegisterForm extends Model
{
    public $username;
    public $mobile;
    public $password;
    public $confirm_password;
    public $confirm_mobile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'mobile'], 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 4, 'max' => 255],

            [['mobile',  'confirm_mobile'], 'required'],
            ['mobile', 'string', 'min'=>10, 'max'=>13],
            //['mobile',  'match', 'pattern' => '/^\+?[1-9]\d{1,14}$/'],
            ['confirm_mobile', 'compare', 'compareAttribute'=>'mobile', 'message'=>"Mobile number don't match" ],
            
            [['password',  'confirm_password'], 'required'],
            [['password','confirm_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ]
        ];
    }

    /**
     * Register user.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->mobile = $this->mobile;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : false;
    }
}