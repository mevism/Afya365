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
            'user_id' => $this->integer()->defaultValue(1),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string()->null(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->null(),
            'date_of_birth' => $this->date(),
            'gender' => $this->string()->notNull(),
            'blood_group' => $this->string()->notNull(),
            'county_of_residence' => $this->string()->notNull(),
            'sub_county' => $this->string()->notNull(),
            'address' => $this->string()->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'isDeleted'=>$this->integer()->notNull()->defaultValue(0)
            
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
