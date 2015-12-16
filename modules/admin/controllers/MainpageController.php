<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\GuideSettingMainpage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * MainpageController implements the CRUD actions for GuideSettingMainpage model.
 */
class MainpageController extends adminController
{

    public function actionIndex()
    {
        return $this->render('view', [
            'model' => $this->findModel(2),
        ]);
    }

    /**
     * Updates an existing GuideSettingMainpage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(2);

        $current_image = $model->main_logo;
        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'main_logo');
            if ($file && $file->tempName) 
            {
                $model->image_file = $file;
                if ($model->validate(['image_file'])) 
                {
                    $dir = Yii::getAlias('uploads/mainpage/');
                    $fileName = $model->image_file->baseName . '.' . $model->image_file->extension;
                    $model->image_file->saveAs($dir . $fileName);
                    $model->image_file = $fileName; // без этого ошибка
                    $model->main_logo = $fileName;
                    Image::thumbnail($dir . $fileName, 150, 150)->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
                }
            }
            if($model->del_img) { $model->main_logo = null; }
            if($model->save())
            {
                if($model->del_img)
                {
                    //если файл существует
                    if(is_file(Yii::getAlias('@webroot'.'/uploads/mainpage/'.$current_image)))
                    {
                        //удаляем файл
                        unlink(Yii::getAlias('@webroot'.'/uploads/mainpage/'.$current_image));
                    }
                }
                
                return $this->redirect('index');
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
     * Finds the GuideSettingMainpage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuideSettingMainpage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuideSettingMainpage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
