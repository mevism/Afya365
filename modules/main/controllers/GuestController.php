<?php

namespace modules\main\controllers;

use Yii;
use models\Otp;
use models\Verify;
use forms\LoginForm;
use forms\RegisterForm;
use components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                'only' => ['logout','verify','login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['verify','login'],
                        'allow' => true,
                        'roles' => ['?']
                    ]]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'verify' => ['post']
                ]]
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
            if (($user = $model->register())) {
                
                return Otp::sendToken($user->id) ? $this->apiGenerated($user) : false ;
            }
        }
        return $this->apiValidated($model->errors);
    }

    /**
     * 
     * verify token
     */

    public function actionVerify(){

        $dataRequest['Verify'] = Yii::$app->request->post();
        $model = new Verify();
        if ($model->load($dataRequest)){
            if (($result = $model->verify())) {
                return $this->apiSuccess($result);
            }
        } 
        return $this->apiValidated($model->errors);

    }
}

