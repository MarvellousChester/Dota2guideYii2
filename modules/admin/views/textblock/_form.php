<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Textblock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="textblock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

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
            'imageManagerJson' => Url::to(['/site/images-get']),
            //'fileUpload' => Url::to(['/site/file-upload']),
            'imageUpload' => Url::to(['/site/image-upload']),
            'plugins' => 
            [
                'clips',
                'table',
                'fontfamily',
                'fontsize',
                'fontcolor',
                'textdirection',
                'imagemanager',
                'video',
                'fullscreen',
            ],
        ],

    ]); ?>

    <?= $form->field($model, 'is_on_mainpage')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
