<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Slider', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'image',
                'label' => 'Image',
                'format' => 'raw',
                'value' => function($data)
                {
                    $height = 100;
                    $width = $height/1.77;
                    return $data->getImage($height, $width);
                },
                'filter' => false,
            ],
            'text',
            'url',
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
