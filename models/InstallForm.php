<?php
namespace yii\easyii\models;

use Yii;
use yii\base\Model;

class InstallForm extends Model
{
    const RETURN_URL_KEY = 'easyii_install_root_password';
    const ROOT_PASSWORD_KEY = 'easyii_install_success_return';

    public $root_password;
    public $recaptcha_key = '';
    public $recaptcha_secret = '';
    public $robot_email = '';
    public $admin_email = '';
    public $telegram_chat_id = '';
    public $telegram_bot_token = '';
    public $metrika = '';

    public function rules()
    {
        return [
            [['root_password', 'admin_email'], 'required'],
            ['root_password', 'string', 'min' => 6],
            [['recaptcha_key', 'recaptcha_secret'], 'string'],
            [['robot_email', 'admin_email'], 'email'],
            [['telegram_chat_id', 'telegram_bot_token', 'metrika'], 'string'],
            [['root_password', 'recaptcha_key', 'recaptcha_secret', 'robot_email', 'admin_email'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'root_password' => Yii::t('easyii/install', 'Root password'),
            'admin_email' => Yii::t('easyii/install', 'Admin E-mail'),
            'robot_email' => Yii::t('easyii/install', 'Robot E-mail'),
            'telegram_chat_id' => Yii::t('easyii/install', 'Telegram chat ID'),
            'telegram_bot_token' => Yii::t('easyii/install', 'Telegram bot token'),
            'metrika' => Yii::t('easyii/install', 'Yandex.Metrika counter'),
        ];
    }

    public function init()
    {
        $this->robot_email = 'noreply@' . Yii::$app->request->serverName;
        if(strpos($this->robot_email, '.') === false){
            $this->robot_email .= '.com';
        }
    }
}