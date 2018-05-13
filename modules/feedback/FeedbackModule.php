<?php
namespace yii\cms\modules\feedback;

class FeedbackModule extends \yii\cms\components\Module
{
    public $settings = [
        'mailAdminOnNewFeedback' => true,
        'subjectOnNewFeedback' => 'New feedback',
        'templateOnNewFeedback' => '@cms/modules/feedback/mail/en/new_feedback',

        'answerTemplate' => '@cms/modules/feedback/mail/en/answer',
        'answerSubject' => 'Answer on your feedback message',
        'answerHeader' => 'Hello,',
        'answerFooter' => 'Best regards.',

        'telegramAdminOnNewFeedback' => false,
        'telegramTemplateOnNewFeedback' => '@cms/modules/feedback/telegram/en/new_feedback',

        'enableTitle' => false,
        'enableEmail' => true,
        'enablePhone' => true,
        'enableText' => true,
        'enableCaptcha' => false,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Feedback',
            'ru' => 'Обратная связь',
        ],
        'icon' => 'earphone',
        'order_num' => 60,
    ];
}