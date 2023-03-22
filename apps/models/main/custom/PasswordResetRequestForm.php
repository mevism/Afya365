<?php

namespace userModels;

use Yii;
use models\User;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

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
        $x =  '+254'. substr($this->mobile, -9);
        return [
            ['mobile', 'trim'],
            ['mobile', 'required'],
            [['mobile'], PhoneInputValidator::class, 'region' => ['KE'], 'message' => 'Invalid mobile number, use the format +254xxxxxxxxx'],
            [['mobile'], 'string', 'length' => 13, 'notEqual' => 'Mobile Number can only be 13 digits.'],
            ['mobile', 'exist', 'targetClass' => User::class,'targetAttribute'=>'mobile', 'message' => 'There is no user with this mobile number.'],
        ];
    }

    public function passwordResetRequest(){

        $user  =  User::findOne(['mobile'=> '+254' . substr($this->mobile, -9)]);
        if (!$user) {
            return false;
        }
      
        return  $user;

    }
}