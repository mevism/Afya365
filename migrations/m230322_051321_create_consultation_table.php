<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%consultation}}`.
 */
class m230322_051321_create_consultation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%consultation}}', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'doctor_comments' => $this->text(),
            'prescription' => $this->text(),
            'status' => $this->integer(),
        ]);
        $this->addForeignKey('FK_doctor_details_consultation','{{%consultation}}','doctor_id','{{%doctor_details}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%consultation}}');
        $this->dropForeignKey('FK_doctor_details_consultation','{{%consultation}}');

    }
}
