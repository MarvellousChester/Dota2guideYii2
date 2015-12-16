<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'label' => 'ID',
                'value' => function($data) { return $data->id; },
                'options' => ['width' => '100'],
            ],
            'title',
            [
                'attribute' => 'image',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data)
                {
                    return \yii\helpers\HtmlPurifier::process($data->getImage(100, 100));
                },
                'filter' => false,
            ],
            //'content:ntext',
            'author',
            'created',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => function($data) 
                {
                    return ($data->status == 1)? "Visible" : "Hidden";
                },
                'filter' => [0=>'Hiden', 1=>'Visible'],
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Category',
                'format' => 'raw',
                'value' => function($data) 
                {
                    return $data->category->getImage(24,24).' '.$data->category->title;
                },
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'title'),
                'options' => ['width' => '120'],
            ],
            'attribute',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
