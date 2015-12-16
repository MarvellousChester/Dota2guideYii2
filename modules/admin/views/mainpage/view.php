<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GuideSettingMainpage */

$this->title = 'Mainpage settings';
$this->params['breadcrumbs'][] = ['label' => 'Mainpage settings', 'url' => ['index']];

?>
<div class="guide-setting-mainpage-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'main_logo',
            'main_logo_text',
            'tel',
            'email:email',
            'article_grid_size',
            'footer_text:ntext',
        ],
    ]) ?>

</div>
