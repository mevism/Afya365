<?php

namespace modules\main\controllers;

use Yii;
use components\Controller;
use doctorModels\Doctorschedule;
use yii\web\NotFoundHttpException;
use adminSearch\DoctorScheduleSearch;

/**
 * DoctorScheduleController implements the CRUD actions for Doctorschedule model.
 */
class ScheduleController extends Controller
{
    
   
    public function actionIndex()
    {
        $search['DoctorScheduleSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new DoctorScheduleSearch();
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

    public function actionUpdate($id){

        $dataRequest['Doctorschedule'] = Yii::$app->request->getBodyParams();
        $model = $this->findModel($id);
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiUpdateDelete($model);
        }

        return $this->apiValidated($model->errors);
    }

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()) {
            return $this->apiUpdateDelete(true);
        }
        return $this->apiUpdateDelete(false);
    }


   
    protected function findModel($id)
    {
        if (($model = Doctorschedule::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested record does not exist.');
    }
}
