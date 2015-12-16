<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['/site/blog?category=']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="blog-view-image"><?=$model->getImage(600, 100)?></div>
    <div class="blog-view-content"><?=$model->content?></div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            /*[
                'label' => false,
                'format' => 'raw', 
                'value' => $model->content
            ],*/
            'author',
            'created',
            [
                'label' => 'Category', 
                'value' => $model->category->title,
            ],
        ],
    ]) ?>

</div>
