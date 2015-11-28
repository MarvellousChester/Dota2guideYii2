<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $fullname
 * @property string $created
 * @property integer $ban
 * @property integer $role
 */
class GuideUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'fullname', 'ban', 'role'], 'required'],
            [['created'], 'safe'],
            [['ban', 'role'], 'integer'],
            [['username'], 'string', 'max' => 15],
            [['email', 'fullname'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 50],
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email'], 'message' => 'The combination of Username and Email has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'fullname' => 'Fullname',
            'created' => 'Created',
            'ban' => 'Ban',
            'role' => 'Role',
        ];
    }

    /**
     * @inheritdoc
     * @return GuideUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GuideUserQuery(get_called_class());
    }
}
