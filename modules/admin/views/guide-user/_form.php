<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GuideUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord) echo $form->field($model, 'password')->passwordInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?php if(\Yii::$app->user->can('admin')) echo $form->field($model, 'role')->dropDownList(['user' => 'User', 'admin' => 'Admin']); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
