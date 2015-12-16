<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Category;

//$this->registerJsFile('js/jquery-1.11.3.min.js');
$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-blog">
    <div class="blog-category-filter">
    <?php $form = ActiveForm::begin(
    [
        'action' => Url::to(['site/blog']),
        'method' => 'get',
        'options' => 
        [
            'enctype' => 'multipart/form-data',
            'class' => 'dropDownForm'
        ]
    ]); ?>
    
    <p>View: 
        <?php
       	echo Html::activeDropDownList($searchModel, 'category', 
            ArrayHelper::map(Category::find()->all(), 'id', 'title'), 
            [
                'prompt' => 'All categories',
                'onchange'=>'this.form.submit()',
                'name' => 'category'
            ]
                    
            );?>
    </p>
    
    <?php ActiveForm::end(); ?>
    </div>
    <div>
    <p id="sort-by">Sort by:</p>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'layout' => "{sorter} {summary} {items}<br />{pager}",
            'options' => 
            [
                'class' => 'blog',
            ]
        ]); ?>
    </div>
</div>