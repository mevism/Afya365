<?php

namespace modules\main\controllers;

use Yii;
use components\Controller;
use userModels\Appointment;
use yii\web\NotFoundHttpException;
use adminSearch\AppointmentSearch;

/**
 * AppointmentController implements the CRUD actions for Appointment model.
 */
class AppointmentController extends Controller
{
    
    public function actionIndex()
    {
        $search['AppointmentSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new AppointmentSearch();
        $dataProvider = $searchModel->search($search);

        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
        
    }   

    public function actionView($id)
    {
        return $this->apiSuccess($this->findModel($id));
    }
 
    public function actionCreate()
    {
        $dataRequest['Appointment'] = Yii::$app->request->getBodyParams();
        $model = new Appointment();

        if($model->load($dataRequest)) {
            $model->appointment_number  =  $model->code();
            if($model->validate()){
                $model->save();
                return $this->apiGenerated($model);
            }
            
        }

        return $this->apiValidated($model->errors);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionWithdraw($id)
    {
        if($this->findModel($id)->delete()) {
            return $this->apiUpdateDelete(true);
        }
        return $this->apiUpdateDelete(false);
    }
    

    protected function findModel($id)
    {
        if (($model = Appointment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested record does not exist.');
    }
}
