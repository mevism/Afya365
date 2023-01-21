<?php

namespace adminModels;

use yii;
use models\Admin;
use yii\base\Model;

class ChangePhone extends Model
{

    public $current_mobile;
    public $new_mobile;  
    public $confirm_mobile;
    
    public function rules()
    {
        return [
            [['current_mobile','confirm_mobile','new_mobile'], 'required'],
            [['current_mobile'], 'validatePhone'],
            ['current_mobile', 'exist', 'targetClass' => Admin::class, 'targetAttribute' => 'mobile', 'message' => 'An account with similar mobile number does not exist.'],
           
             [['new_mobile'], 'string', 'max' => 13, 'min' => 10, 'notEqual' => 'Mobile Number can only be 10 or 13 digits.'],
            ['confirm_mobile', 'compare', 'compareAttribute'=>'new_mobile', 'message'=>"mobile numbers don't match" ],

        ];
    }

    public function validatePhone($attribute, $params)
    {
        $user =  Admin::findOne(['id' =>Yii::$app->user->identity, 'mobile' => $this->current_mobile]);
        if (!$user || !$this->current_mobile) {
            $this->addError($attribute, 'Incorrect mobile number.');
        }

    }



    public function changePhone()
    {
        if ($this->validate()) {
            $user =  Admin::findOne(['id' =>Yii::$app->user->identity, 'mobile' => $this->current_mobile]);
            $user->mobile = $this->new_mobile;
            if ($user->save(false)) {
                return ['status' => 'mobile number changed successfully.'];
            }
          
        }
        return false;
    }

}