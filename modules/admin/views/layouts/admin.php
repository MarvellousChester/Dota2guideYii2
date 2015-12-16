<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\GuideSettingMainpage;

use kartik\sidenav\SideNav;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    

    <?php    
    NavBar::begin([
        'brandLabel' => 'Welcome to admin panel!',
        'brandUrl' => ['/admin/mainpage'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style' => 'min-height: 60px; height: auto',
        ],
        
    ]);
    
    echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Back to mainpage', 'url' => ['/site/index']],
        ['label' => 'Mainpage settings', 'items' => [
            ['label' => 'Main settings', 'url' => ['/admin/mainpage']],
            ['label' => 'Textblocks settings', 'url' => ['/admin/textblock']],
            ['label' => 'Slider settings', 'url' => ['/admin/slider']],
        ]],
        ['label' => 'Users', 'url' => ['/admin/guide-user']],
        ['label' => 'Categories', 'url' => ['/admin/category']],
        ['label' => 'Articles', 'url' => ['/admin/article']],
          
    ],

    ]);
    
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
