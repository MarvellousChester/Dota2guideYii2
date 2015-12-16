<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistrationForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use app\models\GuideUser;
use app\models\GuideUserSearch;

use \app\models\ArticleSearchBlog;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'images-get' => [
            'class' => 'vova07\imperavi\actions\GetAction',
            'url' => Url::base().'/uploads/article_img/', // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot'.'/uploads/article_img/'), // Or absolute path to directory where files are stored.
            //'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
            'class' => 'vova07\imperavi\actions\UploadAction',
            'url' => Url::base().'/uploads/article_img/', // Directory URL address, where files are stored.
            'path' => Yii::getAlias('@webroot'.'/uploads/article_img/'), // Or absolute path to directory where files are stored.
            ],
        ];
    }

    public function actionIndex()
    {
        $slider = ArrayHelper::toArray(\app\models\Slider::find()->all(), 
        [
            'app\models\Slider' => 
            [
                'content' => function ($model) {return Html::a($model->getImage(600, 300), $model->url); },
                'caption' => function ($model) {return Html::a($model->text, $model->url); },
            ],
        ]);
        
        $searchModelTB = new \app\models\TextblockSearch();
        $dataProviderTB = $searchModelTB->search(['TextblockSearch'=>['is_on_mainpage'=>1]]);
        
        $searchModelA = new ArticleSearchBlog();
        $searchModelA->page_size = \app\models\GuideSettingMainpage::getSettings()->article_grid_size;
        $dataProviderA = $searchModelA->search(['ArticleSearchBlog'=>['status'=>1, 'attribute'=>1]]);
        
        return $this->render('index', [
            'dataProviderTB' => $dataProviderTB,
            'dataProviderA' => $dataProviderA,
            'slider' => $slider,
        ]);
    }

    public function actionBlog($category)
    {
        $searchModel = new ArticleSearchBlog();
        $searchModel->category_id = $category;
        $searchModel->page_size = 9;
        $dataProvider = $searchModel->search(['ArticleSearchBlog'=>['status'=>1]]);
        return $this->render('blog/blog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        return $this->render('blog/view', [
            'model' => $this->findArticle($id),
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    
    public function actionRegistration()
    {
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->registration()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    
    
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    protected function findArticle($id)
    {
        if (($model = \app\models\Article::findOne($id)) !== null) 
        {
            if($model->status == 1) return $model;
            else throw new NotFoundHttpException('The requested page does not exist.');
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
}
