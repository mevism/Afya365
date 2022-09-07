<?php

namespace modules\main\controllers;

use components\Controller;
use models\Profile;
use yii\web\NotFoundHttpException;
use search\ProfileSearch;
use Yii;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        $search['ProfileSearch'] = Yii::$app->request->queryParams;
        $searchModel  = new ProfileSearch();
        $dataProvider = $searchModel->search($search);

        return $this->apiSuccess([
            'count'      => $dataProvider->count,
            'dataModels' => $dataProvider->models,
        ], $dataProvider->totalCount);
    }

    public function actionCreate()
    {
        $dataRequest['Profile'] = Yii::$app->request->getBodyParams();
        $model = new Profile();
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiGenerated($model);
        }

        return $this->apiValidated($model->errors);
    }

    public function actionUpdate($id)
    {
        $dataRequest['Profile'] = Yii::$app->request->getBodyParams();
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
        if(($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This record does not exist');
        }
    }
}
