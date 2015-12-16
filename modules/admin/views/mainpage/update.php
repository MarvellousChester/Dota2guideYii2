<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GuideSettingMainpage */

$this->title = 'Update Guide Setting Mainpage: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Guide Setting Mainpages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guide-setting-mainpage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
