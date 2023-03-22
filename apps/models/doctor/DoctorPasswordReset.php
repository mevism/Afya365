<?php

namespace doctorModels;

use Yii;
use models\User;
use userModels\Otp;
use yii\base\Model;
use userModels\PasswordHistory;


/**
 * @OA\Schema(
 *     schema="DoctorPasswordReset",
 *     title="DoctorPasswordReset ",
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
class DoctorPasswordReset extends Model
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
            [['password', 'user_id', 'confirm_password'], 'required'],
            ['password', 'validatePassword'],
            ['password', 'match', 'pattern' => '/^\S*(?=\S*[\W])(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'message'=>'Password Should contain at atleast: 1 number, 1 lowercase letter, 1 uppercase letter and 1 special character'],
            [['password'], 'string', 'min' => 8],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ]
        ];
    }
    
    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
            $this->_user = Otp::findOne(['user_id' => $this->user_id,'status'=>1, 'type'=> 'Doctor password reset']);
            if (is_null($this->_user)) {
                $this->addError($attribute, 'Invalid Request.');
            } else {
            if (($user = $this->_user) !== null) {
                $user = PasswordHistory::findOne(['user_id' => $this->_user->user_id, 'previous_password' => md5($this->password)]);
                if (!is_null($user)) {
                    $this->addError($attribute, 'Choose a password you have not used before');
                }
            }else{
                $this->addError($attribute, null);
            }
        }
    }
    }

    public function resetPassword()
    {
        
        $user =  User::findOne(['id'=>$this->user_id]);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save(false)) {
            $passwordHistory = new PasswordHistory;
            $passwordHistory->user_id = $user->getId();
            $passwordHistory->previous_password = md5($this->password);
            $passwordHistory->save(false);

            return $passwordHistory->save() ? $user : false;            
        }
        return false;
    }

}

