<?php

namespace app\controllers;
use app\models\GuideUser;
use app\models\GuideUserSearch;
use app\models\ProfileUpdateForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use Yii;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new GuideUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('updateOwnProfile', ['id' => $id])) 
        {
            throw new ForbiddenHttpException('Access denied');
        }
        
        $user = $this->findModel($id);
        $model = $model = new ProfileUpdateForm($user); 

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['view', 'id' => $user->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * @return User the loaded model
     */
    private function findModel($id)
    {
        //return GuideUser::findOne(Yii::$app->user->identity->getId());
        if (($model = GuideUser::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) 
        {
            if (!\Yii::$app->user->can($action->id)) 
            {
                throw new ForbiddenHttpException('You do not have permission to view this page');
            }
            return true;
        } else 
        {
            return false;
        }
    }

}
