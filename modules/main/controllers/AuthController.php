<?php

namespace modules\main\controllers;

use components\Controller;
use Yii;

class AuthController extends Controller
{
    public function actionMe()
    {
        $user = Yii::$app->user->identity;
       /** set the token*/
        unset($user['token']);

        return $this->apiSuccess($user);
    }
}
