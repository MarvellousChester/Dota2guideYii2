<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

/**
 * This is the model class for table "{{%setting_mainpage}}".
 *
 * @property integer $id
 * @property string $main_logo
 * @property string $main_logo_text
 * @property string $tel
 * @property string $email
 * @property string $article_grid_size
 * @property string $footer_text
 */
class GuideSettingMainpage extends \yii\db\ActiveRecord
{
    public $image_file;
    public $del_img;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting_mainpage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['main_logo', 'main_logo_text', 'tel', 'email', 'footer_text'], 'required'],
            [['footer_text'], 'string'],
            [['main_logo_text', 'tel', 'email'], 'string', 'max' => 30],
            [['article_grid_size'], 'integer'],
            [['image_file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_logo' => 'Main logo',
            'main_logo_text' => 'Main logo text',
            'tel' => 'Tel',
            'email' => 'Email',
            'article_grid_size' => 'Number of articles',
            'footer_text' => 'Footer text',
            'del_img' => 'Delete image',
        ];
    }
    public static function getSettings()
    {
        $model=GuideSettingMainpage::findOne(2);
        return $model;
        
    }
    public function getLogo($width, $height)
    {
        $current_image = Yii::getAlias('@webroot'.'/uploads/mainpage/'.$this->main_logo);

        if(is_file($current_image))
        {
            return Html::img(Url::base().'/uploads/mainpage/'.$this->main_logo,[/*'width'=>$width,*/'height'=>$height]);
        }
        else return Html::img(Url::base().'/uploads/no-image.png',[/*'width'=>$width,*/'height'=>$height]);
    }
}
