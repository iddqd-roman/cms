<?php
namespace yii\cms\modules\gallery;

class GalleryModule extends \yii\cms\components\Module
{
    public $settings = [
        'categoryThumb' => true,
        'itemsInFolder' => false,
        'categoryTags' => true,
        'categorySlugImmutable' => false,
        'categoryDescription' => true,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Photo Gallery',
            'ru' => 'Фотогалерея',
        ],
        'icon' => 'camera',
        'order_num' => 90,
    ];
}