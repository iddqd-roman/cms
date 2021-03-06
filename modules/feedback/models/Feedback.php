<?php
namespace yii\cms\modules\feedback\models;

use Yii;
use yii\cms\behaviors\CalculateNotice;
use yii\cms\helpers\Mail;
use yii\cms\helpers\Telegram;
use yii\cms\models\Setting;
use yii\cms\modules\feedback\FeedbackModule;
use yii\cms\validators\ReCaptchaValidator;
use yii\cms\validators\EscapeValidator;
use yii\helpers\Url;

class Feedback extends \yii\cms\components\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_VIEW = 1;
    const STATUS_ANSWERED = 2;

    const FLASH_KEY = 'eaysiicms_feedback_send_result';

    public $reCaptcha;

    public static function tableName()
    {
        return 'cms_feedback';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            /*['email', 'required', 'when' => function($model) { return (!FeedbackModule::setting('enablePhone') || !$model->phone); }],
            ['phone', 'required', 'when' => function($model) { return (!FeedbackModule::setting('enableEmail') || !$model->email); }],
            ['text', 'required', 'when' => function($model) { return FeedbackModule::setting('enableText'); }],*/
            [['name', 'email', 'phone', 'title', 'text'], 'trim'],
            [['name','title', 'text'], EscapeValidator::className()],
            ['title', 'string', 'max' => 128],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^[\d\s-\+\(\)]+$/'],
            ['reCaptcha', ReCaptchaValidator::className(), 'when' => function($model){
                return $model->isNewRecord && FeedbackModule::setting('enableCaptcha');
            }],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert){
                $this->ip = Yii::$app->request->userIP;
                $this->time = time();
                $this->status = self::STATUS_NEW;
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
            'email' => 'E-mail',
            'name' => Yii::t('cms', 'Name'),
            'title' => Yii::t('cms', 'Title'),
            'text' => Yii::t('cms', 'Text'),
            'answer_subject' => Yii::t('cms/feedback', 'Subject'),
            'answer_text' => Yii::t('cms', 'Text'),
            'phone' => Yii::t('cms/feedback', 'Phone'),
            'reCaptcha' => Yii::t('cms', 'Anti-spam check')
        ];
    }

    public function behaviors()
    {
        return [
            'cn' => [
                'class' => CalculateNotice::className(),
                'callback' => function(){
                    return self::find()->status(self::STATUS_NEW)->count();
                }
            ]
        ];
    }

    public function mailAdmin()
    {
        if(!FeedbackModule::setting('mailAdminOnNewFeedback')){
            return false;
        }
        return Mail::send(
            Setting::get('admin_email'),
            FeedbackModule::setting('subjectOnNewFeedback'),
            FeedbackModule::setting('templateOnNewFeedback'),
            ['feedback' => $this, 'link' => Url::to(['/admin/feedback/a/view', 'id' => $this->primaryKey], true)]
        );
    }

    public function telegramAdmin()
    {
        if(!FeedbackModule::setting('telegramAdminOnNewFeedback')){
            return false;
        }
        return Telegram::send(
            Setting::get('telegram_bot_token'),
            Setting::get('telegram_chat_id'),
            FeedbackModule::setting('telegramTemplateOnNewFeedback'),
            ['feedback' => $this, 'link' => Url::to(['/admin/feedback/a/view', 'id' => $this->primaryKey], true)]
        );
    }

    public function sendAnswer()
    {
        return Mail::send(
            $this->email,
            $this->answer_subject,
            FeedbackModule::setting('answerTemplate'),
            ['feedback' => $this],
            ['replyTo' => Setting::get('admin_email')]
        );
    }
}