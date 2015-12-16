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
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property string $created
 * @property integer $status
 * @property integer $category_id
 * @property string $image
 * @property integer $attribute
 *
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{
    public $image_file;
    public $del_img;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author', 'category_id'], 'required'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['status', 'category_id', 'attribute'], 'integer'],
            [['title', 'author'], 'string', 'max' => 30],
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
            'title' => 'Title',
            'content' => 'Content',
            'author' => 'Author',
            'created' => 'Created',
            'status' => 'Status',
            'category_id' => 'Category',
            'image' => 'Image',
            'attribute' => 'Attribute',
            'del_img' => 'Удалить изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    public function getImage($width, $height)
    {
        $current_image = Yii::getAlias('@webroot'.'/uploads/article_img/'.$this->image);

        if(is_file($current_image))
        {
            return Html::img(Url::base().'/uploads/article_img/'.$this->image,['width'=>$width/*,'height'=>$height*/]);
        }
        else return Html::img(Url::base().'/uploads/no-image.png',['width'=>$width/*,'height'=>$height*/]);
    }
    
    public function beforeSave($insert)
    {
        
        if(parent::beforeSave($insert))
        {
            if ($this->isNewRecord)
            {
                $this->created = date("Y-m-d H:i:s", time());
            }
            return true;
        }
        else return false;
    }
    
}
