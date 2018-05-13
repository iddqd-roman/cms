<?php
namespace yii\cms\modules\catalog;

class CatalogModule extends \yii\cms\components\Module
{
    public $settings = [
        'categoryThumb' => true,
        'categorySlugImmutable' => false,
        'categoryDescription' => true,
        
        'itemsInFolder' => false,
        'itemThumb' => true,
        'itemPhotos' => true,
        'itemDescription' => true,
        'itemSlugImmutable' => false
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Catalog',
            'ru' => 'Каталог',
        ],
        'icon' => 'list-alt',
        'order_num' => 100,
    ];
}