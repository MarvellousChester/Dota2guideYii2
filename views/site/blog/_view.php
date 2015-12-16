<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="<?=$model->category->title;?>">
    <div class="blog-title">
        <h3><?=Html::a($model->category->getImage(24,24).' '. $model->title, ['view', 'id' => $model->id])?> </h3>
    </div>
    <div class="blog-image">
        <?=Html::a($model->getImage(300, 100),['view', 'id' => $model->id]); ?> 
    </div> 
    <p><?=$model->author;?> / <?=$model->created;?></p>
</div>