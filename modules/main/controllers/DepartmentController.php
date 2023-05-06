<?php

namespace modules\main\controllers;

use components\Controller;
use department\Department;
use yii\web\NotFoundHttpException;
use adminSearch\DepartmentSearch;
use Yii;

class DepartmentController extends Controller
{
    public function actionIndex()
    {
        $search['DepartmentSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new DepartmentSearch();
        $dataProvider = $searchModel->search($search);

        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionCreate()
    {
        $dataRequest['Department'] = Yii::$app->request->getBodyParams();
        $model = new Department();

        if($model->load($dataRequest) && ($model->validate() &&  $model->save())) {
            return $this->apiGenerated($model);
        }

        return $this->apiValidated($model->errors);
    }

    public function actionUpdate($id)
    {
        $dataRequest['Department'] = Yii::$app->request->getBodyParams();
        $model = $this->findModel($id);
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiUpdateDelete($model);
        }

        return $this->apiValidated($model->errors);
    }

    public function actionView($id)
    {
        return $this->apiSuccess($this->findModel($id));
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
        if(($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}


