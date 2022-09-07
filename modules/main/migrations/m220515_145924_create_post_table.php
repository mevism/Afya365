<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m220515_145924_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'code' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'acronym' => Schema::TYPE_TEXT
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
