<?php

namespace modules\main\controllers;

use Yii;
use models\User;
use userModels\Otp;
use forms\LoginForm;
use forms\RegisterForm;
use userModels\Patient;
use userModels\ResendOtp;
use components\Controller;
use userModels\VerifyNumber;
use userModels\PasswordReset;
use userModels\ChangePassword;
use userModels\PasswordHistory;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use userModels\PasswordResetRequestForm;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class GuestController extends Controller
{
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
            return $this->apiSuccess($result, "You have successfully logged in.");
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
                return Otp::sendToken($user->id) ? $this->apiGenerated($user, "Thank you for registration. Please check your phone a code has been sent to you to verify your mobile number.") : false;
            }
        }
        return $this->apiValidated($model->errors);
    }

    /**
     * 
     * verify token
     */
    public function actionVerify()
    {
        $dataRequest['Otp'] = Yii::$app->request->getBodyParams();
        $model = new Otp();
       
        if ($model->load($dataRequest) && ($model->validate() && $otp = $model->verify())) {
            return $this->apiGenerated($otp);
        }
        return $this->apiValidated($model->errors);
    }

    /**
     * 
     * resend token
    */
    public function actionResend()
    {
        $dataRequest['ResendOtp'] = Yii::$app->request->getBodyParams();      
        $model = new ResendOtp();

        if ($model->load($dataRequest)) {
            if($model->validate()){
                if (($user = Otp::sendToken($model->user_id))) {
                    return  $this->apiGenerated($user, "OTP sent Successfully") ;                  
                }
            }
            return $this->apiValidated($model->errors);
        }
    }
    /**
     * refresh token
     */

    public function actionRefresh(){        
        $userRequest = Yii::$app->request->getBodyParams();  
        $user = User::findOne($userRequest['user_id']);  
          return $user;
        }
    /**
     * 
     * request password reset
     */
    
    public function actionRequestpasswordreset(){

        $dataRequest['PasswordResetRequestForm'] = Yii::$app->request->getBodyParams(); 
        $model = new PasswordResetRequestForm();

        if ($model->load($dataRequest) && ($model->validate())){
            if($user = $model->passwordResetRequest()){
                return Otp::sendToken($user->id) ? $this->apiGenerated($user, "Use a code that has been sent to your phone to verify your phone number.") : false;
            }
        }
        return $this->apiValidated($model->errors);
    }

    public function actionResetpassword(){
        $dataRequest['PasswordReset'] = Yii::$app->request->getBodyParams();   
        $model = new PasswordReset();

        if ($model->load($dataRequest)  && ($model->validate() && $user = $model->resetPassword())){                           
            return $this->apiGenerated($user, "password successfully reset");
        }                      
            
            return $this->apiValidated($model->errors);      
    }

    public function actionChangepassword()
    {
        $dataRequest['ChangePassword'] = Yii::$app->request->getBodyParams(); 
        $model = new ChangePassword();

            if ($model->load($dataRequest) &&  ($model->validate() && $model->change())){        
                return $this->apiGenerated($model,  "You have successfully changed your password.");                
            } 
            return $this->apiValidated($model->errors);        
    }

     /**
     * 
     * verify token
     */
    public function actionVerifynumber()
    {
        $dataRequest['VerifyNumber'] = Yii::$app->request->getBodyParams();
        $model = new VerifyNumber();

        if ($model->load($dataRequest) && ($model->validate() && $otp = $model->verifyNumber())) {
            return $this->apiGenerated($otp);
        }
        return $this->apiValidated($model->errors);
    }
    

    public function actionView($id)
    {
        return $this->apiSuccess($this->findModel($id));
    }

    protected function findModel($id)
    {
        if (($model = Patient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}
