<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?php
    if(isset($model->image) && is_file(Yii::getAlias('@webroot'.'/uploads/article_img/'.$model->image)))
    {
        echo Html::img(Url::base().'/uploads/article_img/'.$model->image, ['class'=>'img-responsive']);
        echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
    }
    ?>
    
    
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'content')->widget(Widget::className(),
    [
        // You can either use it for model attribute
        'model' => $model,
        'attribute' => 'content',
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
            'imageManagerJson' => Url::to(['images-get']),
            //'fileUpload' => Url::to(['/site/file-upload']),
            'imageUpload' => Url::to(['image-upload']),
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
    

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Hidden', '1' => 'Visible']) ?>

    <?= $form->field($model, 'category_id')->dropDownList
    (
        ArrayHelper::map(Category::find()->all(), 'id', 'title'),
        ['prompt' => 'Select category']
    ) ?>

    <?= $form->field($model, 'attribute')->dropDownList(['0' => 'Hidden on the mainpage', '1' => 'Visible on the mainpage']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
