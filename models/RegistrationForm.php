<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\GuideUser;


/**
 * RegistrationForm is the model behind the registration form.
 */
 
 class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'email', 'password', 'fullname'], 'required'],
            [['password'], 'string', 'min' => 6, 'max' => 255],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['username', 'unique', 'targetClass' => 'app\models\GuideUser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\GuideUser', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'E-mail',
            'password' => 'Password',
            'fullname' => 'Full name',
            'verifyCode' => 'Verification Code',
        ];
    }
    
    public function registration()
    {
        if ($this->validate())
        {
            $user = new GuideUser();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->fullname = $this->fullname;
            if ($user->save()) 
            {
                return $user;
            }
        }
        return null;
    }
}
?>