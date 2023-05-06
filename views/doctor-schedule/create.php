<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\apps\models\Doctorschedule $model */

$this->title = 'Create Doctorschedule';
$this->params['breadcrumbs'][] = ['label' => 'Doctorschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctorschedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
