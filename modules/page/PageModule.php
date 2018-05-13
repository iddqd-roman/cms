<?php
namespace yii\cms\modules\page;

use Yii;

class PageModule extends \yii\cms\components\Module
{
    public $settings = [
        'slugImmutable' => true,
        'defaultFields' => '[]'
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Pages',
            'ru' => 'Страницы',
        ],
        'icon' => 'file',
        'order_num' => 50,
    ];
}