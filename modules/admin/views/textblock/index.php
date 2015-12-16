<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TextblockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Textblocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="textblock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Textblock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'icon',
            [
                'label' => 'Text',
                'attribute' => 'text',
                'format' => 'raw',
                'value' => function($data) { return $data->text; }
            ],
            [
                'label' => 'Show on the mainpage',
                'attribute' => 'is_on_mainpage',
                'value' => function($data) { return ($data->is_on_mainpage == 1)? "True" : "False"; }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
