<?php

namespace  doctorModels;

use Yii;
use yii\base\Model;
use models\Doctor;
use models\User;

/**
 * @OA\Schema(
 *   schema="DoctorLogin",
 *   type="object",
 *   title="DoctorLogin",
 *   required={"username", "password", "updated_at", "created_at"},
 *  
 * 
 * @OA\Property(
 *     property="username",
 *     type="string",
 * ),
 * 
 *    @OA\Property(
 *     property="password",
 *     type="string",
 *  ),
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

/**
 * @OA\Schema(
 *   schema="CurrentLoggedinDoctor",
 *   type="object",
 *   required={"username", "mobile", "updated_at", "created_at"},
 *   allOf={
 *     @OA\Schema(ref="#/components/schemas/DoctorLogin")
 *   }
 * )
 */
class DoctorLogin extends Model
{  
    public $username;
    public $password;   
    private $_user;

    /** 
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['password'], 'validatePassword'],
        ];
    }

 
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            Yii::$app->user->login($user);
            return $user;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Doctor|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}