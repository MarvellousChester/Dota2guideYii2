<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?php if(isset($model->image) && is_file(Yii::getAlias('@webroot'.'/uploads/category_img/'.$model->image)))
    {
        echo Html::img(Url::base().'/uploads/category_img/'.$model->image, ['class'=>'img-responsive']);
    } ?>
    
    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
