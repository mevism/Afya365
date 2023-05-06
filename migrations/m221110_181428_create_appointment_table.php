<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointment}}`.
 */
class m221110_181428_create_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointment}}', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'patient_id' => $this->integer(),
            'doctor_schedule_id' => $this->integer(),
            'appointment_number' => $this->integer(),
            'reason_for_appointment' => $this->string(),
            'appointment_time' =>$this->timestamp(),
            'doctor_comments' => $this->string(),
            'status' => $this->integer(),
            'patient_come_into_hospital' =>"enum('No','Yes')",
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            '{{%fk-appointment-doctor_schedule_id}}',
            '{{%appointment}}',
            'doctor_schedule_id',
            '{{%doctorschedule}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-appointment-doctor_id}}',
            '{{%appointment}}',
            'doctor_id',
            '{{%doctor}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-appointment-patient_id}}',
            '{{%appointment}}',
            'patient_id',
            '{{%patient}}',
            'id',
            'CASCADE'
        );
 
     
        

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('{{%appointment}}');
        $this->dropForeignKey(
            '{{%fk-appointment-doctor_id}}',
            '{{%fk-appointment-patient_id}}',
           '{{%fk-appointment-doctor_schedule_id}}',
            '{{%appointment}}'
        );
    }
}
