<?php

namespace forms;

use Yii;
use models\User;
use yii\base\Model;
use userModels\Patient;
use userModels\PasswordHistory;

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
            //username rules
            [['username', 'mobile'], 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern'=>'/^[a-z0-9\.]+$/i', 'message' => 'Username can only contain letters, numbers and a dot.','skipOnError'=>true],//Accept if comprised of alphanumeric characters and dots
            ['username', 'unique', 'targetClass' => '\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 3, 'max' => 255],

            //mobile number rules
            [['mobile','confirm_mobile'], 'trim'],
            [['mobile' , 'confirm_mobile'], 'required', 'message' => 'Mobile number is required'],
            [['mobile'], 'string', 'max' => 13, 'min' => 10, 'notEqual' => 'Mobile Number can only be 10 or 13 digits.'],
            [['mobile'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'mobile', 'message' => 'An account with similar mobile number already exists.'],

            ['confirm_mobile', 'compare', 'compareAttribute'=>'mobile','message'=>"Mobile number don't match" ],
            
            //password rules 
            [['password',  'confirm_password'], 'required'],
            ['password', 'match', 'pattern' => '/^\S*(?=\S*[\W])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'message'=>'Password Should contain at atleast: 1 number, 1 lowercase letter, 1 uppercase letter and 1 special character'],
            [['password'], 'string', 'min' => 8],
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
        $user->mobile = '+254' . substr($this->mobile, -9);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save(false)) {
            $profile = new Patient;
            $profile->user_id  = $user->id;
            if ($profile->save(false)){
                $passwordHistory = new PasswordHistory;
                $passwordHistory->user_id = $user->getId();
                $passwordHistory->previous_password = md5($this->password);
                $passwordHistory->save(false);
                return $passwordHistory->save() ? $user : false;
            }
            return false;
        }
        return false;
    }
}