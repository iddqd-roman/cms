<?php
namespace yii\cms\modules\entity;

class EntityModule extends \yii\cms\components\Module
{
    public $settings = [
        'categoryThumb' => true,
        'categorySlugImmutable' => false,
        'categoryDescription' => true,
        'itemsInFolder' => false,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Entities',
            'ru' => 'Объекты',
        ],
        'icon' => 'list-asterisk',
        'order_num' => 95,
    ];
}