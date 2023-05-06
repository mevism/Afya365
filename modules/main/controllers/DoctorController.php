<?php

namespace modules\main\controllers;

use Yii;
// use models\User;
use models\User;
use models\Doctor;
use userModels\Otp;
use components\Controller;
use doctorModels\DoctorLogin;
use doctorModels\DoctorDetails;
use doctorModels\Doctorschedule;
use yii\web\NotFoundHttpException;
use doctorModels\DoctorVerifyNumber;
use adminSearch\DoctorScheduleSearch;
use doctorModels\DoctorPasswordReset;
use doctorModels\DoctorChangePassword;
use doctorModels\DoctorPasswordResetRequestForm;

class DoctorController extends Controller
{
 

    public function actionIndex()
    {
        $search['DoctorDetailsSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new DoctorDetailsSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }


    public function actionLogin()
    {
       $dataRequest['DoctorLogin'] = Yii::$app->request->post();
        $model = new DoctorLogin();
        if ($model->load($dataRequest) && ($result = $model->login())) {            
            return $this->apiSuccess($result, "You have successfully logged in.");
        }
        return $this->apiValidated($model->errors);
    }

    public function actionChangepassword()
    {
        $dataRequest['DoctorChangePassword'] = Yii::$app->request->getBodyParams();
        $model = new DoctorChangePassword();
        if ($model->load($dataRequest) &&  ($model->validate() && $user = $model->change())) {
            return $this->apiGenerated($user, "You have successfully changed your password.");
        }
        return $this->apiValidated($model->errors);
    }

    public function actionDoctorrequestpasswordreset()
    {

        $dataRequest['DoctorPasswordResetRequestForm'] = Yii::$app->request->getBodyParams();
        $model = new DoctorPasswordResetRequestForm();

        if ($model->load($dataRequest) && ($model->validate())){
            if($user = $model->passwordResetRequest()){
                return Otp::sendToken($user->id) ? $this->apiGenerated($user, "Check your phone a code has been sent to verify this mobile number.") : false;
            }
        }
        return $this->apiValidated($model->errors);
    }

    public function actionDoctorverifynumber()
    {
        $dataRequest['DoctorVerifyNumber'] = Yii::$app->request->getBodyParams();
        $model = new DoctorVerifyNumber();
        if ($model->load($dataRequest) && ($model->validate() && $otp = $model->verifyNumber())) {
            return $this->apiGenerated($otp);
        }
        return $this->apiValidated($model->errors);
    }

    public function actionDoctorresetpassword(){
        $dataRequest['DoctorPasswordReset'] = Yii::$app->request->getBodyParams();        
        $model = new DoctorPasswordReset();
        if ($model->load($dataRequest)  && ($model->validate() && $user = $model->resetPassword())){                           
            return $this->apiGenerated($user, "password successfully reset");
        }                
        return $this->apiValidated($model->errors);      
    }

    
    public function actionUpdate($id)
    {
        $dataRequest['DoctorDetails'] = Yii::$app->request->getBodyParams();
        $doctor = Yii::$app->request->getBodyParams();
        $x = $doctor['image'];
        $model = $this->findModel($id);
        $model->setScenario('update');
        if($model->load($dataRequest) && $model->save($model->image = $x)) {
            return $this->apiUpdateDelete($model);
        }

        return $this->apiValidated($model->errors);
    }

    public function actionView($id)
    {
        return $this->apiSuccess($this->findModel($id));
    }

    protected function findModel($id)
    {
        if (($model = DoctorDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }

  

}
