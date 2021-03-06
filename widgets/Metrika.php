<?php

namespace yii\cms\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\cms\assets\DateTimePickerAsset;
use yii\cms\helpers\Data;
use yii\cms\models\Setting;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\AssetBundle;

/**
 * Установка счетчика Я.Метрики
 *
 * Class Metrika
 * @package yii\cms\widgets
 */
class Metrika extends \yii\base\Widget
{
    // Массив настроек счетчика
    public $options = [
        'clickmap' => true,
        'trackLinks' => true,
        'accurateTrackBounce' => true,
        'webvisor' => true,
        'ecommerce' => "dataLayer"
    ];
    // Счетчик будет отключен, если работает режим отладки
    public $disableWhenDebug = true;
    private $yaCounter;

    public function init()
    {
        $this->yaCounter = Setting::get('metrika');
        if (empty($this->yaCounter)) {
            throw new InvalidConfigException('Please install metrika in Settings');
        }

    }

    public function run()
    {
        echo $this->render('metrika', [
            'options' => Json::encode(array_merge([
                'id' => $this->yaCounter,
            ], $this->options)),
            'yaCounter' => $this->yaCounter,
            'disableWhenDebug' => $this->disableWhenDebug,
        ]);
    }
}
