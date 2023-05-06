<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\apps\models\doctor\Consultation $model */

$this->title = 'Update Consultation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Consultations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consultation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
