<?php
namespace yii\cms\modules\menu;

use Yii;

class MenuModule extends \yii\cms\components\Module
{
    public $settings = [
        'slugImmutable' => false
    ];
    
    public static $installConfig = [
        'title' => [
            'en' => 'Menu',
            'ru' => 'Меню',
        ],
        'icon' => 'menu-hamburger',
        'order_num' => 51,
    ];
}