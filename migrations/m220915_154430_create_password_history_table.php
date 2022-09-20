<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%password_history}}`.
 */
class m220915_154430_create_password_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%password_history}}', [
            'password_history_id' => $this->primaryKey(),
            'user_id'  =>  $this->integer()->notNull(),
            'previous_password'  =>  $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('FK_password_history_user','{{%password_history}}','user_id','{{%users}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%password_history}}');
        $this->dropForeignKey('FK_password_history_user','{{%password_history}}');
    }
    
    

  
}
