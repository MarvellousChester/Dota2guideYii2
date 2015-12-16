<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%textblock}}".
 *
 * @property integer $id
 * @property string $icon
 * @property string $text
 * @property integer $is_on_mainpage
 */
class Textblock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%textblock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['is_on_mainpage'], 'integer'],
            [['icon'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icon' => 'Icon',
            'text' => 'Text',
            'is_on_mainpage' => 'Is On Mainpage',
        ];
    }
}
