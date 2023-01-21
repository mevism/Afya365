<?php

namespace modules\main\controllers;

use Yii;
use components\Controller;

class AuthController extends Controller
{
    public function actionMe()
    {
       
        $user = Yii::$app->user->identity;
        return $user;
       /** set the token*/
       unset($user['token']);

        return $this->apiSuccess($user);
    }

 
}
