<?php

namespace userModels;

use yii;
use yii\base\Model;
use models\User;

/**
 * 
 * 
 */
class ChangePassword extends Model
{

    public $current_password;
    public $new_password;  
    public $confirm_password;
    private $_user = false;
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['current_password','confirm_password'], 'required'],
            [['current_password'], 'validatePassword'],

            ['new_password','required',  'message'=>'Please choose a password you can remember'],
            ['new_password', 'string', 'min' =>  8],
            ['new_password', 'match', 'pattern' => '/^\S*(?=\S*[\W])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'message'=>'Password Should contain at atleast: 1 number, 1 lowercase letter, 1 uppercase letter and 1 special character'],
            ['confirm_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>"Passwords don't match" ],

        ];
    }
 
    public function validatePassword($attribute, $params)
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->current_password,$user->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }

    }

    public function change()
    {
        if ($this->validate()) {
            $user =  User::findOne(Yii::$app->user->identity->id); 
            $user->setPassword($this->new_password);
            $user->generateAuthKey();
            if ($user->save(false)) {
                $passwordHistory = new PasswordHistory;
                $passwordHistory->user_id = $user->getId();
                $passwordHistory->previous_password = md5($this->new_password);
                $passwordHistory->save(false);
                return $user;
            }
          
        }
        return false;
    }

    public  function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(Yii::$app->user->identity->id);
        }
        return $this->_user;
    }
}