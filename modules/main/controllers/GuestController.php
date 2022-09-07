<?php

namespace modules\main\controllers;

use components\Controller;
use forms\RegisterForm;
use yii\filters\AccessControl;
use forms\LoginForm;
use Yii;

class GuestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'login', 'register'],
                        'allow' => true,
                    ],

                ],
            ]
        ];
    }

   
    public function actionIndex()
    {
        $params = Yii::$app->params;
        return [
            'name' => $params['name'],
            'description' => $params['description'],
            'version' => $params['version'],
            'createdBy' => $params['createdBy'],
            'email' => $params['adminEmail'],
            'baseUrl' => $this->baseUrl()
        ];
    }

    /**
     * Login
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $dataRequest['LoginForm'] = Yii::$app->request->post();
        $model = new LoginForm();
        if ($model->load($dataRequest) && ($result = $model->login())) {
            return $this->apiSuccess($result);
        }

        return $this->apiValidated($model->errors);
    }

    /**
     * Register
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $dataRequest['RegisterForm'] = Yii::$app->request->getBodyParams();
        $model = new RegisterForm();
        if ($model->load($dataRequest)) {
            if ($user = $model->register()) {
                return $this->apiGenerated($user);
            }
        }

        return $this->apiValidated($model->errors);
    }
}
