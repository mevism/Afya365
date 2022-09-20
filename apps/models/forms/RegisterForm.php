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
 *   required={ "username", "mobile", "password"},
 *
 *  @OA\Property(
 *     property="username",
 *     type="string",
 * ),
 * @OA\Property(
 *     property="mobile",
 *     type="string",
 * ),
 * 
 * @OA\Property(
 *     property="password",
 *     type="string",
 * ),
 *)
 */
class RegisterForm extends Model
{
    public $username;
    public $mobile;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'mobile'], 'trim'],
            [['username','mobile'], 'required'],
            ['username', 'unique', 'targetClass' => '\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['mobile', 'string', 'min'=>10, 'max'=>13],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
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

        return $user->save();
    }
}