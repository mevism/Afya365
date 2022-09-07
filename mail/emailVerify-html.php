<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

// $verifyLink = Yii::$app->urlManager->createAbsoluteUrl();
?>

<div class="verify-email">

    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Your account registration was successful.</p>


</div>
