<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\GuideSettingMainpage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-setting-mainpage-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if(isset($model->main_logo) && is_file(Yii::getAlias('@webroot'.'/uploads/mainpage/'.$model->main_logo)))
    {
        echo Html::img(Url::base().'/uploads/mainpage/'.$model->main_logo, ['class'=>'img-responsive']);
        echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
    } ?>
    
    <?= $form->field($model, 'main_logo')->fileInput() ?>

    <?= $form->field($model, 'main_logo_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'article_grid_size')->textInput() ?>

    <?= $form->field($model, 'footer_text')->widget(Widget::className(),
    [
        // You can either use it for model attribute
        'model' => $model,
        'attribute' => 'footer_text',
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
