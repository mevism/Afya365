<?php

namespace modules\main\controllers;

use Yii;
// use models\User;
use adminModels\Doctor;
use adminModels\DoctorLogin;
use components\Controller;
use adminSearch\DoctorSearch;
use yii\web\NotFoundHttpException;

class DoctorController extends Controller
{
 
    public function actionLogin()
    {
        $dataRequest['DoctorLogin'] = Yii::$app->request->post();
        $model = new DoctorLogin();
        if ($model->load($dataRequest) && ($result = $model->login())) {
            
            return $this->apiSuccess($result, "You have successfully logged in.");
        }
        // if ($model->load($dataRequest) ){
        //     return $result = $model->validate();
        //     return $this->apiSuccess($result, "You have successfully logged in.");
        // }
        return $this->apiValidated($model->errors);
    }
    
    public function actionUpdate($id)
    {
        $dataRequest['Doctor'] = Yii::$app->request->getBodyParams();
        $doctor = Yii::$app->request->getBodyParams();
        $x = $doctor['image'];
        // return $x;
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
        if (($model = Doctor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}
