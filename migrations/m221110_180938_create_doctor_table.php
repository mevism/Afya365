<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doctor}}`.
 */
class m221110_180938_create_doctor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%doctor}}', [
            'id' => $this->primaryKey(),
            'id_number'=>$this->string()->notNull(),
            'first_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'gender' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'speciality' => $this->string()->notNull(),
            'date_of_birth' => $this->date()->notNull(),
            'address' => $this->string()->notNull(),
            'image' => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);    
        $this->addForeignKey(
            '{{%fk-doctor-user_id}}',
            '{{%doctor}}',
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
        $this->dropTable('{{%doctor}}');
        $this->dropForeignKey(
            '{{%fk-doctor-user_id}}',
            '{{%doctor}}'
        );
    }
}
