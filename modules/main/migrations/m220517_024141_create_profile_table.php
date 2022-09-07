<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m220517_024141_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'username' => Schema::TYPE_STRING,
            'first_name' => Schema::TYPE_STRING,
            'middle_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'dob' => Schema::TYPE_DATE,
            'email' => Schema::TYPE_STRING,
            'gender' => Schema::TYPE_STRING,
            'blood_group' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'residence' => Schema::TYPE_STRING,
            'user_id' => Schema::TYPE_INTEGER,
        ]);
        $this->addForeignKey(
            '{{%fk-profile-user_id}}',
            '{{%profile}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
        $this->dropForeignKey(
            '{{%fk-profile-user_id}}',
            '{{%profile}}'
        );
    }
}
