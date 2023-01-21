<?php

namespace userModels;

use Yii;
use models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $mobile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile', 'exist', 'targetClass' => User::class,'targetAttribute'=>'mobile', 'message' => 'There is no user with this mobile number.'],
        ];
    }

    public function passwordResetRequest(){
        $user  =  User::findOne(['mobile'=> $this->mobile]);
        if (!$user) {
            return false;
        }
      
        return  $user;

    }
}