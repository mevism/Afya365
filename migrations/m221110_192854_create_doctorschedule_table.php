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
            'doctor_id' => $this->integer(),
            'schedule_day' => "enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday')",
            'schedule_date'=>$this->datetime(),
            'schedule_start' => $this->string(),
            'schedule_end' => $this->string(),
            'average_consulting_time' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            '{{%fk-doctorschedule-doctor_id}}',
            '{{%doctorschedule}}',
            'doctor_id',
            '{{%doctor}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doctorschedule}}');
        $this->dropForeignKey(
            '{{%fk-doctorschedule-doctor_id}}',
            '{{%doctorschedule}}'
        );
    }
}
