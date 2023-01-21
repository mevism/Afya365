<?php

namespace  adminModels;

use Yii;
use yii\base\Model;
use models\Admin;

/**
 * @OA\Schema(
 *   schema="AdminLogin",
 *   type="object",
 *   title="AdminLogin",
 *   required={"username", "mobile", "updated_at", "created_at"},
 *  
 * 
 * @OA\Property(
 *     property="username",
 *     type="string",
 * ),
 * 
 *    @OA\Property(
 *     property="mobile",
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
 *   schema="CurrentLoggedinUser",
 *   type="object",
 *   required={"username", "mobile", "updated_at", "created_at"},
 *   allOf={
 *     @OA\Schema(ref="#/components/schemas/AdminLogin")
 *   }
 * )
 */
class AdminLoginForm extends Model
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
            ['password', 'validatePassword'],
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
     * @return Admin|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }
}