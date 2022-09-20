<?php

namespace app\models;

use Yii;

class Otp extends \yii\db\ActiveRecord
{

      /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['token'], 'required'],
            [['token'], 'string','min'=>4,'max'=>6]
        ];
    }
}