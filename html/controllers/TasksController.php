<?php

namespace app\controllers;

use Yii;
use app\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{
    
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $ownerListId = \Yii::$app->request->get('ownerListId');
        $model = new Tasks();
        $model->lists = $ownerListId;
        $model->done = '0';
        
        if (empty($model->getLists())) throw new \yii\web\HttpException(404, 'Page not found');
        
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

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $model = new Tasks();
        $model->lists = \Yii::$app->request->get('ownerListId');
        $model->done = '0';
        
        $model->load(Yii::$app->request->post());
        $model->save();
        
        return $this->redirect(['index', 'ownerListId' => $model->lists]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        return $this->redirect(['index', 'ownerListId' => $model->lists]);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
