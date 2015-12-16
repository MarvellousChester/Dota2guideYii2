<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;
/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends adminController
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'image');
            if ($file && $file->tempName) 
            {
                $model->image_file = $file;
                if ($model->validate(['image_file'])) 
                {
                    $dir = Yii::getAlias('uploads/category_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
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
     * Updates an existing Category model.
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
                    $dir = Yii::getAlias('uploads/category_img/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->image = $fileName;
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
