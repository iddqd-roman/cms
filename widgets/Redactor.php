<?php
namespace yii\cms\widgets;

use Yii;
use yii\cms\models\Setting;
use yii\helpers\Url;

class Redactor extends \vova07\imperavi\Widget
{
    public function init()
    {
        $this->defaultSettings = [
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/redactor/image-upload']),
            'fileUpload' => Url::to(['/admin/redactor/file-upload']),
            'imageManagerJson' => Url::to(['/admin/redactor/images-get']),
            'fileManagerJson' => Url::to(['/admin/redactor/files-get']),
            'plugins' => Setting::getAsArray('redactor_plugins'),
            'replaceDivs' => false,
        ];
        if(Yii::$app->language !== 'en-US') {
            if(Yii::$app->language === 'zh-CN'){
                $lang = 'zh_cn';
            } else {
                $lang = substr(Yii::$app->language, 0, 2);
            }
            $this->defaultSettings['lang'] = $lang;
        }
        parent::init();
    }
}