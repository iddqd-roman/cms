<?php
namespace yii\cms\helpers;

use Yii;
use yii\base\InvalidConfigException;
use yii\cms\models\Setting;

class Mail
{
    /**
     * @param string $toEmail
     * @param string $subject
     * @param mixed $template
     * @param array $data
     * @param array $options
     * @return bool
     * @throws InvalidConfigException
     */
    public static function send($toEmail, $subject, $template, $data = [], $options = [])
    {
        if(empty(Yii::$app->mailer) || !Yii::$app->mailer instanceof \yii\mail\BaseMailer) {
            throw new InvalidConfigException('cmsCMS required `mailer` component.');
        }
        /** @var \yii\mail\BaseMailer $mailer */
        $mailer = Yii::$app->mailer;
        if($mailer->htmlLayout) {
            $htmlLayoutFile = (strpos($mailer->htmlLayout, '@') !== false ? Yii::getAlias($mailer->htmlLayout) : Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'mail' . DIRECTORY_SEPARATOR . $mailer->htmlLayout) . '.php';
            if(!file_exists($htmlLayoutFile)) {
                throw new InvalidConfigException('Cannot find html layout for mails. Please create it at `' . $htmlLayoutFile . '`');
            }
        }
        if(!filter_var($toEmail, FILTER_VALIDATE_EMAIL) || !$subject || !$template){
            return false;
        }
        $data['subject'] = trim($subject);

        $message = $mailer->compose($template, $data)
            ->setTo($toEmail)
            ->setSubject($data['subject']);

        if(filter_var(Setting::get('robot_email'), FILTER_VALIDATE_EMAIL)){
            $message->setFrom(Setting::get('robot_email'));
        }

        if(!empty($options['replyTo']) && filter_var($options['replyTo'], FILTER_VALIDATE_EMAIL)){
            $message->setReplyTo($options['replyTo']);
        }
        if(!empty($options['cc']) && filter_var($options['cc'], FILTER_VALIDATE_EMAIL)){
            $message->setCc($options['cc']);
        }

        return $message->send();
    }
}