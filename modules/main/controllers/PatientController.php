<?php

namespace modules\main\controllers;

use Yii;
use DateTime;
use models\User;
use DateInterval;
use userModels\Patient;
use search\PatientSearch;
use components\Controller;
use userModels\Appointment;
use yii\web\NotFoundHttpException;

class PatientController extends Controller
{
    public function actionIndex()
    {
        $search['PatientSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new PatientSearch();
        $dataProvider = $searchModel->search($search);
        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionUpdate($id)
    {
        $dataRequest['Patient'] = Yii::$app->request->getBodyParams();
        $model = $this->findModel($id);

        $date = new DateTime();
        $p = $date->sub(new DateInterval('P145Y'));
        $max = $p->format('Y-m-d');
              
        if ($model->load($dataRequest) && $model->save($model->status = true)) {
            if($model->date_of_birth < $max){
                return $this->apiValidated($model->errors, 'The patient is too old.');
            }
   
            $p = $model->status;
            if($p){
                $model->user_id = Yii::$app->user->id;
                $user = User::findOne(['id' => Yii::$app->user->id]);
                
                if ($user) {
                    $user->is_patient_profile_updated = true;
                    return $user->save()  ? $this->apiUpdateDelete($model) : false;
                }
            }
        }

        return $this->apiValidated($model->errors);
    }

    public function actionView($id)
    {
        return $this->apiSuccess($this->findModel($id));
    }

    public function actionAppointment()
    {
        $dataRequest['Appointment'] = Yii::$app->request->getBodyParams();
        $model = new Appointment();

      /*   if($model->load($dataRequest) ){

        return $model->appointment();
        } */
        if($model->load($dataRequest)) {
            $model->appointment_number  =  $model->code();
            if($model->validate()){
                $model->save();
                return $this->apiGenerated($model);
            }
            
        }

        return $this->apiValidated($model->errors);
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
