<?php

namespace app\modules\admin\controllers;

use yii\web\ForbiddenHttpException;

class adminController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) 
        {
            $this->layout = 'admin';
            if (!\Yii::$app->user->can('admin')) 
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
