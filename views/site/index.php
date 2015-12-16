<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
$this->title = 'Dota2Guide';
?>
<div class="site-index">

    <div class="jumbotron textblocks">
        <div>
            <?= ListView::widget([
            'dataProvider' => $dataProviderTB,
            'itemView' => '_view_textblock',
            'layout' => "{items}",
            'options' => 
            [
                'class' => 'textblocks',
            ]
        ]); ?>
        
        </div>

    </div>

    <div class="body-content">
        <?php
	       echo Carousel::widget(
           [
            'items' => $slider,
            'options' => 
            [
                'style' => 'width:600px;'
            ]
           
           ]);
        ?>
    
        <?= ListView::widget([
            'dataProvider' => $dataProviderA,
            'itemView' => '_view_article',
            'layout' => "{items}",
            'options' => 
            [
                'class' => 'blog mainpage-articles',
            ]
        ]); ?>
        <div id="body-helper"></div>  
            </div>
        </div>

    </div>
</div>
