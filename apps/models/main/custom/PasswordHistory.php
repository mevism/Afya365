<?php

namespace userModels;

use Yii;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%password_history}}".
 *
 * @property int $user_id
 * @property string $old_password
 * @property int $created_at
 */
class PasswordHistory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%password_history}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'previous_password'], 'required'],
            [['user_id'], 'integer'],
            [['previous_password'], 'string', 'max' => 255],
        ];
    }
}
