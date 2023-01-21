<?php

namespace adminModels;

use Yii;
use models\Admin;
use yii\base\Model;

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