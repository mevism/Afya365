<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doctorschedule}}`.
 */
class m221110_192854_create_doctorschedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%doctorschedule}}', [
            'id' => $this->primaryKey(),
            'staff_number' => $this->string()->notNull(),
            'schedule_date'=>$this->datetime()->notNull(),
            'schedule_start' => $this->string()->notNull(),
            'schedule_end' => $this->string()->notNull(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doctorschedule}}');
       
    }
}
