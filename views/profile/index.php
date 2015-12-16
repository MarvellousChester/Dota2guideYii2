<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GuideUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => 
        [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            //'password',
            'fullname',
             'created',
             'role',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
