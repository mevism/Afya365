<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

// $verifyLink = Yii::$app->urlManager->createAbsoluteUrl();
?>

<div class="verify-email">

    <p>Hello <?= Html::encode($user->username) ?>,</p>
  

    <p>Your account registration at <?= Yii::$app->name ?> was successful. Click on the below button to activate your account.</p>


</div>
