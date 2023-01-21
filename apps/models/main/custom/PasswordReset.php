<?php

namespace userModels;

use Yii;
use models\User;
use yii\base\Model;
use userModels\PasswordHistory;
use Psr\Log\InvalidArgumentException;

/**
 * @OA\Schema(
 *     schema="PasswordReset",
 *     title="PasswordReset ",
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
class PasswordReset extends Model
{
    public $password; 
    public $user_id;
    public $confirm_password;
    private $_user;

   
    public static function tableName()
    {
        return '{{%users}}';
    }

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
    // public function validatePassword($attribute, $params)
    // {
    //     if (!$this->hasErrors()) {
      
    //         $user =  User::findOne(['id'=>$this->user_id]);
    //         return $user;
    //         if ($user  !== null) {
    //             $user = PasswordHistory::findOne(['user_id' => $user->getId(), 'previous_password' => md5($this->password)]);
    //             if (!is_null($user)) {
    //                 $this->addError($attribute, 'Choose a password you have not used before');
    //             }
    //         }else{
    //             $this->addError($attribute, null);
    //         }
    //     }
    //     return 'prrr';
    // }

    // public function resetPassword()
    // {
    //     // $otp =  Otp::find(['user_id'=>$this->user_id])->one(); 
 
    //     // return $otp;
    //     $user =  User::find(['id'=>$this->user_id])->one();
    //     return $user;
    //     $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    //     // $user->removePasswordResetToken();
    //     $user->generateAuthKey();
    //     if ($user->save(false)) {
    //         $passwordHistory = new PasswordHistory;
    //         $passwordHistory->user_id = $user->getId();
    //         $passwordHistory->previous_password = md5($this->password);
    //         $passwordHistory->save(false);
    //         return ['status' => 'Password reset successfully.'];
    //     }
    //     return false;
    // }


}

