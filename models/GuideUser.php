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
class GuideUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['username', 'email', 'password', 'fullname'], 'required'],
            [['created'], 'safe'],
            [['ban'], 'integer'],
            [['username'], 'string', 'max' => 15],
            [['email', 'fullname', 'role'], 'string', 'max' => 30],
            [['password'], 'string', 'min' => 6, 'max' => 255],
            [['username'], 'unique', 'targetAttribute' => ['username'], 'message' => 'This username has already been taken.'],
            [['email'], 'unique', 'targetAttribute' => ['email'], 'message' => 'This Email has already been taken.'],
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
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
     
    public function getId()
    {
        return $this->id;
    }
    
    public function getAuthKey()
    {

    }
    public function getRole()
    {
        if($this->isGuest) return 'guest';
        return $this->role;
    }
    
    public function validateAuthKey($authKey)
    {

    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \yii::$app->security->validatePassword($password, $this->password);
    }
    
    public function beforeSave($insert)
    {
        
        if(parent::beforeSave($insert))
        {
            if ($this->isNewRecord)
            {
                $this->created = date("Y-m-d H:i:s", time());
                $this->role = 'user';
                $this->ban = 0;
                $this->password = \yii::$app->security->generatePasswordHash($this->password, 10);
            }
            return true;
        }
        else return false;
    }

    
}
