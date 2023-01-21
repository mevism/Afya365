<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m221126_012411_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%users}}',
        [
            'username' => 'admin',
            'mobile' => '0720000000',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' =>Yii::$app->security->generatePasswordHash('admin'),
            'password_reset_token' =>Yii::$app->security->generateRandomString() . time(),
             
            'status' =>10 ,
            'created_at' => time(),
            'updated_at' => time(),
        ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
    }
}
