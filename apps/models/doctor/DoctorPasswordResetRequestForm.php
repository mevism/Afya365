<?php

namespace doctorModels;

use Yii;
use models\User;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * Password reset request form
 */
class DoctorPasswordResetRequestForm extends Model
{
    public $mobile;

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
            ['mobile', 'trim'],
            ['mobile', 'required'],
            [['mobile'], PhoneInputValidator::class, 'region' => ['KE'], 'message' => 'Invalid mobile number, use the format +254xxxxxxxxx'],
            [['mobile'], 'string', 'length' => 13, 'notEqual' => 'Mobile Number can only be 13 digits.'],
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