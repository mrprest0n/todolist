<?php

namespace app\controllers;

use Yii;
use app\models\Lists;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ListsController extends Controller
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
        $dataProvider = new ActiveDataProvider([
            'query' => Lists::find()->where(['user' => Yii::$app->user->identity->id]),
            'pagination' => [ 'pageSize' => 5 ],
        ]);

        $model = new Lists();
        $model->user = Yii::$app->user->identity->id;
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Lists();
        $model->dt_create = date('Y-m-d');
        $model->dt_change = date('Y-m-d');
        $model->user = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        else
        {
            throw new HttpException(400, 'Что-то пошло не так.');
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->dt_change = date('Y-m-d');

        if ($model->load(Yii::$app->request->post())) {  
            if ($model->save())
            {
                return $this->redirect(['index']);
            }
            else
            {
                throw new HttpException(400, 'Что-то пошло не так.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete() !== false)
        {
            return $this->redirect(['index']);
        }
        else
        {
            throw new HttpException(400, 'Что-то пошло не так.');
        }
    }

    protected function findModel($id)
    {
        if (($model = Lists::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница, отвечающая запросу, не найдена.');
    }
}
