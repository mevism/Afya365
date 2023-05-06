<?php

namespace modules\main\controllers;

use Yii;
use components\Controller;
use yii\web\NotFoundHttpException;
use doctorModels\Consultation;
use adminSearch\ConsultationSearch;

/**
 * ConsultationController implements the CRUD actions for Consultation model.
 */
class ConsultationController extends Controller
{

    public function actionIndex()
    {
        $search['ConsultationSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new ConsultationSearch();
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
        $dataRequest['Consultation'] = Yii::$app->request->getBodyParams();
        $model = new Consultation();

        if ($model->load($dataRequest) && ($model->save())){
       
                return $this->apiGenerated($model);
            
        }
        return $this->apiValidated($model->errors);
    }


    public function actionUpdate($id)
    {

        $dataRequest['Consultation'] = Yii::$app->request->getBodyParams();
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
        if (($model = Consultation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested record does not exist.');
    }
}
