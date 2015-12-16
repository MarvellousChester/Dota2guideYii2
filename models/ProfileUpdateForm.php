<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * ProfileUpdateForm is the model behind the user profile form.
 */
 class ProfileUpdateForm extends Model
{
    public $username;
    public $email;
    public $fullname;
    
    /**
     * @var User
     */
    private $_user;
    
    public function __construct(GuideUser $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }
    
    public function init()
    {
        $this->username = $this->_user->username;
        $this->email = $this->_user->email;
        $this->fullname = $this->_user->fullname;
        parent::init();
    }
    
    public function rules()
    {
        return [
            [['email', 'username'], 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => GuideUser::className(),
                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
                'filter' => function (ActiveQuery $query) {
                        $query->andWhere(['<>', 'id', $this->_user->id]);
                    },
            ],
            [
                'username',
                'unique',
                'targetClass' => GuideUser::className(),
                'message' => Yii::t('app', 'ERROR_USERNAME_EXISTS'),
                'filter' => function (ActiveQuery $query) {
                        $query->andWhere(['<>', 'id', $this->_user->id]);
                    },
            ],
            [['email','fullname'], 'string', 'max' => 255],
        ];
    }
    
    public function update()
    {
        if ($this->validate()) 
        {
            $user = $this->_user;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->fullname = $this->fullname;
            return $user->save();
        } else {
            return false;
        }
    }
}
?>