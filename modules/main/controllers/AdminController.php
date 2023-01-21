<?php

namespace modules\main\controllers;

use Yii;
use DateTime;
use DateInterval;
use models\Admin;
use userModels\Otp;
use adminModels\Doctor;
use components\Controller;
use adminModels\ChangePhone;
use adminSearch\DoctorSearch;
use adminModels\DoctorDetails;
use adminModels\AdminLoginForm;
use adminModels\ChangePassword;
use adminModels\Doctorschedule;
use userModels\PasswordHistory;
use adminModels\AdminVerifyNumber;
use yii\web\NotFoundHttpException;
use adminModels\AdminPasswordReset;
use yii\web\BadRequestHttpException;
use adminModels\AdminPasswordResetRequestForm;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

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
        // return $model;
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

        $userRequest = Yii::$app->request->getBodyParams();
        $x = $userRequest['mobile'];
        $number =  Admin::findOne(['mobile' => '+254' . substr($x, -9)]);

        if ($model->load($dataRequest) && ($model->validate($model->mobile = $number))){
            if($user = $model->passwordResetRequest()){
                return Otp::sendToken($user->id) ? $this->apiGenerated($user, "Check your phone a code has been sent to verify this mobile number.") : false;
            }
            return $this->apiValidated($model->errors);
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
        $userRequest = Yii::$app->request->getBodyParams();  
        $model = new AdminPasswordReset();
        $user_id = $userRequest['user_id'];
    
              
        if ($model->load($dataRequest)  && $model->validate() ){     
            $user =  Admin::findOne(['id'=>$user_id]);
        
            if ($user  !== null) {
                $user = PasswordHistory::findOne(['user_id' => $user->getId(), 'previous_password' => md5($model->password)]);
                if (!is_null($user)) {
                    return $this->apiValidated($model->errors,'Choose a password you have not used before');
                }
            }else{
                return $this->apiValidated($model->errors,'user does not exist');
            }
            $otp =  Otp::findOne(['user_id'=>$user_id,'type'=>"admin password reset", 'status'=>1]);
            if($otp){
                $user =  Admin::findOne(['id'=>$user_id]);
                $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                if($user->save(false)){
                    $passwordHistory = new PasswordHistory;
                    $passwordHistory->user_id = $user->getId();
                    $passwordHistory->previous_password = md5($model->password);
                    $passwordHistory->save(false);
                    return $this->apiGenerated($user, "password successfully reset");
                }
                return false;
                
            }
                 
            } 
            return $this->apiValidated($model->errors);      
    }

    public function actionCreatedoctor()
    {
        $dataRequest['DoctorDetails'] = Yii::$app->request->getBodyParams();
        $model = new DoctorDetails();

        // return $model;
        $userRequest = Yii::$app->request->getBodyParams();
        $number = '+254' . substr($userRequest['phone_number'], -9);

        $date = new DateTime();
        $p = $date->sub(new DateInterval('P27Y'));
        $max = $p->format('Y-m-d');
        // return $max;
        if ($model->load($dataRequest) && $model->validate()) {
            if($model->save([
                $model->staff_number = 'DR' .rand(9999, 4),
                $model->phone_number = $number,         
            ])){
               
               $detail =  $model->id;
                $doctor = new Doctor;
                $doctor->doctor_details_id  = $detail;
                $doctor->auth_key =  Yii::$app->security->generateRandomString();
                $doctor->password_hash = Yii::$app->security->generatePasswordHash($model->id_number);
                $doctor->status  =  10;
                $doctor->save();
                }
            
            if($model->date_of_birth > $max){
                return $this->apiValidated($model->errors, 'Too young to be a doctor.');
            }
       
            
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

    public function actionSchedule()
    {
        $dataRequest['Doctorschedule'] = Yii::$app->request->getBodyParams();
        $model = new Doctorschedule();
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiGenerated($model);
        }

        return $this->apiValidated($model->errors);
    }

    protected function findDoctorModel($id)
    {
        if(($model = Doctor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}
