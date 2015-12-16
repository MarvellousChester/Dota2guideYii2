<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if(isset($model->image) && is_file(Yii::getAlias('@webroot'.'/uploads/mainpage/slider_img/'.$model->image)))
    {
        echo Html::img(Url::base().'/uploads/mainpage/slider_img/'.$model->image, ['class'=>'img-responsive']);
    } ?>
    
    <?= $form->field($model, 'image')->fileInput() ?>
    
    <?= $form->field($model, 'text')->widget(Widget::className(),
    [
        // You can either use it for model attribute
        'model' => $model,
        'attribute' => 'text',
        // Some options, see http://imperavi.com/redactor/docs/
        'settings' => 
        [
            //'toolbar' => false,
            //'css' => 'wym.css',
            'lang' => 'ru',
            'minHeight' => 200,
            'buttons' => ['html', 'formatting', 'bold', 'italic', 'underline', 'deleted', 'unorderedlist', 'orderedlist', 
            'outdent', 'indent', 'image', 'video', 'file', 'table', 'link', 'alignment', 'horizontalrule', 
            'alignleft', 'aligncenter', 'alignright', 'justify'],
            'plugins' => 
            [
                'clips',
                'table',
                'fontfamily',
                'fontsize',
                'fontcolor',
                'textdirection',
                'fullscreen',
            ],
        ],

    ]); ?>
    
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
