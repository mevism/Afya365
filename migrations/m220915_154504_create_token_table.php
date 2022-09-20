<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m220915_154504_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'access_token_id' => $this->primaryKey(),
            'user_id'  =>  $this->integer()->notNull(),
            'token'  =>  $this->integer()->notNull(),
            'type'  =>  $this->string()->notNull(),
            'status'  =>  $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
         $this->addForeignKey('FK_token_user','{{%token}}','user_id','{{%users}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%token}}');
        $this->dropForeignKey('FK_token_user','{{%token}}');
    }
}
