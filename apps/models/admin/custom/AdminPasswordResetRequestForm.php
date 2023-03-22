<?php

namespace adminModels;

use Yii;
use models\Admin;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * Password reset request form
 */
class AdminPasswordResetRequestForm extends Model
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
            [['mobile'], PhoneInputValidator::class, 'region' => ['KE'], 'message' => 'Invalid mobile number, use the format +254xxxxxxxxx'],
            [['mobile'], 'string', 'length' => 13, 'notEqual' => 'Mobile Number can only be 13 digits.'],
            ['mobile', 'exist', 'targetClass' => Admin::class,'targetAttribute'=>'mobile', 'message' => 'There is no user with this mobile number.'],
        ];
    }

    public function passwordResetRequest(){
        $user  =  Admin::findOne(['mobile'=> $this->mobile]);
        if (!$user) {
            return false;
        }
      
        return  $user;
    }
}