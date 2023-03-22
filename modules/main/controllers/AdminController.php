<?php

namespace modules\main\controllers;

use Yii;
use userModels\Otp;
use components\Controller;
use adminModels\ChangePhone;
use adminSearch\DoctorSearch;
use adminModels\AdminLoginForm;
use adminModels\ChangePassword;
use doctorModels\DoctorDetails;
use doctorModels\Doctorschedule;
use adminModels\AdminVerifyNumber;
use yii\web\NotFoundHttpException;
use adminModels\AdminPasswordReset;
use adminModels\AdminPasswordResetRequestForm;

class AdminController extends Controller
{

    public function actionLogin()
    {
        $dataRequest['AdminLoginForm'] = Yii::$app->request->post();
        $model = new AdminLoginForm();
        if ($model->load($dataRequest) && ($result = $model->login())) {
            return $this->apiSuccess($result, "You have successfully logged in.");
        }
        return $this->apiValidated($model->errors);
    }

    public function actionAdminchangepassword()
    {
        $dataRequest['ChangePassword'] = Yii::$app->request->getBodyParams();
        $model = new ChangePassword();
        if ($model->load($dataRequest) &&  ($model->validate() && $user = $model->change())) {
            return $this->apiGenerated($user, "You have successfully changed your password.");
        }
        return $this->apiValidated($model->errors);
    }

    public function actionChangemobilenumber()
    {
        $dataRequest['ChangePhone'] = Yii::$app->request->getBodyParams();
        $model = new ChangePhone();
        if ($model->load($dataRequest) &&  ($model->validate() && $model->changePhone())) {
            return $this->apiGenerated($model);
        }
        return $this->apiValidated($model->errors);
    }


    public function actionAdminrequestpasswordreset()
    {
        $dataRequest['AdminPasswordResetRequestForm'] = Yii::$app->request->getBodyParams();
        $model = new AdminPasswordResetRequestForm();
        if ($model->load($dataRequest) && ($model->validate())){
            if($user = $model->passwordResetRequest()){
                return Otp::sendToken($user->id) ? $this->apiGenerated($user, "Check your phone a code has been sent to verify this mobile number.") : false;
            }
        }
        return $this->apiValidated($model->errors);
    }

    public function actionAdminverifynumber()
    {
        $dataRequest['AdminVerifyNumber'] = Yii::$app->request->getBodyParams();
        $model = new AdminVerifyNumber();
        if ($model->load($dataRequest) && ($model->validate() && $otp = $model->verifyNumber())) {
            return $this->apiGenerated($otp);
        }
        return $this->apiValidated($model->errors);
    }

    public function actionAdminresetpassword()
    {
        $dataRequest['AdminPasswordReset'] = Yii::$app->request->getBodyParams();   
        $model = new AdminPasswordReset();  
        if ($model->load($dataRequest)  && ($model->validate() && $user = $model->resetPassword())){                           
            return $this->apiGenerated($user, "password successfully reset");
        }      
            return $this->apiValidated($model->errors);      
    }

    public function actionCreatedoctor()
    {
        $dataRequest['DoctorDetails'] = Yii::$app->request->getBodyParams();
        $model = new DoctorDetails();
        if ($model->load($dataRequest) && ($model->validate() && $model->checkDoctor())){
            return $this->apiGenerated($model);
        }   
        return $this->apiValidated($model->errors);
    }


    public function actionDoctorindex()
    {
        $search['DoctorSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new DoctorSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionViewdoctor($id)
    {
        return $this->apiSuccess($this->findDoctorModel($id));
    }

    public function actionDeletedoctor($id)
    {
        if($this->findDoctorModel($id)->delete()) {
            return $this->apiUpdateDelete(true);
        }
        return $this->apiUpdateDelete(false);
    }
    public function actionDoctorschedule()
    {
          $dataRequest['Doctorschedule'] = Yii::$app->request->getBodyParams();
           $model = new Doctorschedule();     

        if($model->load($dataRequest)) {

            return $model->schedule();
            // return $this->apiGenerated($model);
        }

        // if($model->load($dataRequest) && $model->save()) {
        //     return $this->apiGenerated($model);
        // }
        return $this->apiValidated($model->errors);
    }

    protected function findDoctorModel($id)
    {
        if(($model = DoctorDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}
