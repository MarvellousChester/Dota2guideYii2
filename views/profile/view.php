<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GuideUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (\Yii::$app->user->can('updateOwnProfile', ['id' => $model->id])) echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'fullname',
            'created',
            'role',
        ],
    ]) ?>

</div>
