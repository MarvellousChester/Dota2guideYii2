<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $icon
 *
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
    public $image_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 62535],
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
            'image' => 'Icon'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public function getImage($width, $height)
    {
        $current_image = Yii::getAlias('@webroot'.'/uploads/category_img/'.$this->image);

        if(is_file($current_image))
        {
            return Html::img(Url::base().'/uploads/category_img/'.$this->image,['width'=>$width,'height'=>$height]);
        }
        else return Html::img(Url::base().'/uploads/no-image.png',['width'=>$width,'height'=>$height]);
    }
    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
