<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\apps\models\Doctorschedule $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctorschedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'schedule_date')->textInput() ?>

    <?= $form->field($model, 'schedule_start')->textInput() ?>

    <?= $form->field($model, 'schedule_end')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
