<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Slider;
use app\models\SliderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends adminController
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

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider model.
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
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();

        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'image');
            if ($file && $file->tempName) 
            {
                $model->image_file = $file;
                if ($model->validate(['image_file'])) 
                {
                    $dir = Yii::getAlias('uploads/mainpage/slider_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
                    Image::thumbnail($dir . $fileName, 1920, 1080)->save($dir . $fileName);
                    Image::thumbnail($dir . $fileName, 150, 150)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
                }
            }
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Slider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $current_image = $model->image;
        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'image');
            if ($file && $file->tempName) 
            {
                $model->image_file = $file;
                if ($model->validate(['image_file'])) 
                {
                    $dir = Yii::getAlias('uploads/mainpage/slider_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
                    Image::thumbnail($dir . $fileName, 1920, 1080)->save($dir . $fileName);
                    Image::thumbnail($dir . $fileName, 150, 150)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
                }
            }
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Slider model.
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
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
