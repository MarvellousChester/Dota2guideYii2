<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Textblock;
use app\models\TextblockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * TextblockController implements the CRUD actions for Textblock model.
 */
class TextblockController extends adminController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            
            'images-get' => [
            'class' => 'vova07\imperavi\actions\GetAction',
            'url' => Url::base().'/uploads/mainpage/textblock_img/', // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot'.'/uploads/mainpage/textblock_img/'), // Or absolute path to directory where files are stored.
            //'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
            'class' => 'vova07\imperavi\actions\UploadAction',
            'url' => Url::base().'/uploads/mainpage/textblock_img/', // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot'.'/uploads/mainpage/textblock_img/'), // Or absolute path to directory where files are stored.
            ],
        ];
    }
    /**
     * Lists all Textblock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TextblockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Textblock model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Textblock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Textblock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Textblock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Textblock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Textblock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Textblock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Textblock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
