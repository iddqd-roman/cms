<?php

namespace yii\cms\models;

use Yii;
use yii\cms\components\ActiveRecord;

use yii\cms\validators\EscapeValidator;

class LoginForm extends ActiveRecord
{
    const CACHE_KEY = 'SIGNIN_TRIES';

    private $_user = false;

    public static function tableName()
    {
        return 'cms_loginform';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], EscapeValidator::className()],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('cms', 'Username'),
            'password' => Yii::t('cms', 'Password'),
            'remember' => Yii::t('cms', 'Remember me')
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('cms', 'Incorrect username or password.'));
            }
        }
    }

    public function login()
    {
        $cache = Yii::$app->cache;

        if(($tries = (int)$cache->get(self::CACHE_KEY)) > 5){
            $this->addError('username', Yii::t('cms', 'You tried to login too often. Please wait 5 minutes.'));
            return false;
        }

        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->time = time();

        if ($this->validate()) {
            $this->password = '******';
            $this->success = 1;
        } else {
            $this->success = 0;
            $cache->set(self::CACHE_KEY, ++$tries, 300);
        }
        $this->insert(false);

        return $this->success ? Yii::$app->user->login($this->getUser(), Setting::get('auth_time') ?: null ) : false;

    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Admin::findByUsername($this->username);
        }

        return $this->_user;
    }
}
