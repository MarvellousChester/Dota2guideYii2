<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
/**
 * This is the model class for table "{{%slider}}".
 *
 * @property integer $id
 * @property string $image
 * @property string $text
 * @property string $url
 * @property string $created
 */
class Slider extends \yii\db\ActiveRecord
{
    public $image_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['url', 'text'], 'string'],
            [['image_file'], 'file', 'extensions' => 'png, jpg',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'text' => 'Text',
            'url' => 'Url',
            'created' => 'Created',
        ];
    }
    public function getImage($width, $height)
    {
        $current_image = Yii::getAlias('@webroot'.'/uploads/mainpage/slider_img/'.$this->image);

        if(is_file($current_image))
        {
            return Html::img(Url::base().'/uploads/mainpage/slider_img/'.$this->image,['width'=>$width,'height'=>$height]);
        }
        else return Html::img(Url::base().'/uploads/no-image.png',['width'=>$width,'height'=>$height]);
    }
    public function beforeSave($insert)
    {
        
        if(parent::beforeSave($insert))
        {
            if ($this->url == '') $this->url = null;
            if ($this->text == '') $this->text = null;
            if ($this->isNewRecord)
            {
                $this->created = date("Y-m-d H:i:s", time());
            }
            return true;
        }
        else return false;
    }
}
