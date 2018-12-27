<?php

namespace app\controllers;

use Yii;
use app\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

class TasksController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $ownerListId = \Yii::$app->request->get('ownerListId');
        $model = new Tasks();
        $model->lists = $ownerListId;
        $model->done = '0';
        
        if (empty($model->getLists())) 
        {
            throw new HttpException(404, 'Page not found');
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()->where(['lists' => $ownerListId]),
            'pagination' => [ 'pageSize' => 5 ],
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'ownerListId' => $ownerListId,
        ]);
    }
    
    public function actionCreate()
    {        
        $model = new Tasks();
        $model->lists = \Yii::$app->request->get('ownerListId');
        $model->done = '0';
        
        $model->load(Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(['index', 'ownerListId' => $model->lists]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'ownerListId' => $model->lists]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        return $this->redirect(['index', 'ownerListId' => $model->lists]);
    }
    
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
