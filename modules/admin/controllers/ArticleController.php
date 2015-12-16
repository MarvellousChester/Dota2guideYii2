<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends adminController
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'image');
            if ($file && $file->tempName) 
            {
                $model->image_file = $file;
                if ($model->validate(['image_file'])) 
                {
                    $dir = Yii::getAlias('uploads/article_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
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
     * Updates an existing Article model.
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
                    $dir = Yii::getAlias('uploads/article_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
                    Image::thumbnail($dir . $fileName, 150, 150)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
                }
            }
            if($model->del_img) { $model->image = null;}
            if($model->save())
            {
                if($model->del_img)
                {
                    //если файл существует
                    if(is_file(Yii::getAlias('@webroot'.'/uploads/article_img/'.$current_image)))
                    {
                        //удаляем файл
                        unlink(Yii::getAlias('@webroot'.'/uploads/article_img/'.$current_image));
                    }
                }
                
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
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) 
        {
            if (!\Yii::$app->user->can($action->id)) 
            {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else 
        {
            return false;
        }
    }
}
