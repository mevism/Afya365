<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\apps\models\Appointment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appointment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'appointment_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason_for_appointment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appointment_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
