<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%consultation}}`.
 */
class m230306_162636_create_consultation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%consultation}}', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'patient_id' => $this->integer(),
            'doctor_remarks' => $this->string(),
            'status' => $this->integer(),
        ]);
        $this->addForeignKey(
            '{{%fk-consultation-doctor_id}}',
            '{{%consultation}}',
            'doctor_id',
            '{{%doctordetails}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%fk-consultation-patient_id}}',
            '{{%consultation}}',
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
        $this->dropTable('{{%consultation}}');
        $this->dropForeignKey(
            '{{%fk-consultation-doctor_id}}',
            '{{%fk-consultation-patient_id}}',
            '{{%consultation}}'
        );
    }
}
