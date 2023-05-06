<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\apps\models\Doctorschedule $model */

$this->title = 'Update Doctorschedule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doctorschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doctorschedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
