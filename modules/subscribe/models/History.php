<?php
namespace yii\cms\modules\subscribe\models;

use Yii;

class History extends \yii\cms\components\ActiveRecord
{
    public static function tableName()
    {
        return 'cms_subscribe_history';
    }

    public function rules()
    {
        return [
            [['subject', 'body'], 'required'],
            ['subject', 'trim'],
            ['sent', 'number', 'integerOnly' => true],
            ['time', 'default', 'value' => time()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'subject' => Yii::t('cms/subscribe', 'Subject'),
            'body' => Yii::t('cms/subscribe', 'Body'),
        ];
    }
}