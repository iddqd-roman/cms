<?php
namespace yii\cms\modules\guestbook\models;

use Yii;
use yii\cms\behaviors\CalculateNotice;
use yii\cms\helpers\Mail;
use yii\cms\helpers\Telegram;
use yii\cms\models\Setting;
use yii\cms\modules\guestbook\GuestbookModule;
use yii\cms\validators\ReCaptchaValidator;
use yii\cms\validators\EscapeValidator;
use yii\helpers\Url;

class Guestbook extends \yii\cms\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    const FLASH_KEY = 'eaysiicms_guestbook_send_result';

    public $reCaptcha;

    public static function tableName()
    {
        return 'cms_guestbook';
    }

    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['name', 'title', 'text'], 'trim'],
            [['name', 'title', 'text'], EscapeValidator::className()],
            ['email', 'email'],
            ['title', 'string', 'max' => 128],
            ['reCaptcha', ReCaptchaValidator::className(), 'on' => 'send', 'when' => function(){
                return GuestbookModule::setting('enableCaptcha');
            }],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert){
                $this->ip = Yii::$app->request->userIP;
                $this->time = time();
                $this->new = 1;
                $this->status = GuestbookModule::setting('preModerate') ? self::STATUS_OFF : self::STATUS_ON;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $this->mailAdmin();
            $this->telegramAdmin();
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('cms', 'Name'),
            'title' => Yii::t('cms', 'Title'),
            'email' => 'E-mail',
            'text' => Yii::t('cms', 'Text'),
            'answer' => Yii::t('cms/guestbook', 'Answer'),
            'reCaptcha' => Yii::t('cms', 'Anti-spam check')
        ];
    }

    public function behaviors()
    {
        return [
            'cn' => [
                'class' => CalculateNotice::className(),
                'callback' => function(){
                    return self::find()->where(['new' => 1])->count();
                }
            ]
        ];
    }

    public function mailAdmin()
    {
        if(!GuestbookModule::setting('mailAdminOnNewPost')){
            return false;
        }
        return Mail::send(
            Setting::get('admin_email'),
            GuestbookModule::setting('subjectOnNewPost'),
            GuestbookModule::setting('templateOnNewPost'),
            [
                'post' => $this,
                'link' => Url::to(['/admin/guestbook/a/view', 'id' => $this->primaryKey], true)
            ]
        );
    }

    public function telegramAdmin()
    {
        if(!GuestbookModule::setting('telegramAdminOnNewPost')){
            return false;
        }
        return Telegram::send(
            Setting::get('telegram_bot_token'),
            Setting::get('telegram_chat_id'),
            GuestbookModule::setting('telegramTemplateOnNewPost'),
            ['post' => $this, 'link' => Url::to(['/admin/guestbook/a/view', 'id' => $this->primaryKey], true)]
        );
    }

    public function notifyUser()
    {
        return Mail::send(
            $this->email,
            GuestbookModule::setting('subjectNotifyUser'),
            GuestbookModule::setting('templateNotifyUser'),
            [
                'post' => $this,
                'link' => Url::to([GuestbookModule::setting('frontendGuestbookRoute')], true)
            ]
        );
    }
}