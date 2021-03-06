<?php
namespace yii\cms\modules\news;

class NewsModule extends \yii\cms\components\Module
{
    public $settings = [
        'enableThumb' => true,
        'enablePhotos' => true,
        'enableShort' => true,
        'enableSource' => true,
        'shortMaxLength' => 256,
        'enableTags' => true,
        'slugImmutable' => false
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'News',
            'ru' => 'Новости',
        ],
        'icon' => 'bullhorn',
        'order_num' => 70,
    ];
}