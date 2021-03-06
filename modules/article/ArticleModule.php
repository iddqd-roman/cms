<?php
namespace yii\cms\modules\article;

class ArticleModule extends \yii\cms\components\Module
{
    public $settings = [
        'categoryThumb' => true,
        'categorySlugImmutable' => false,
        'categoryDescription' => true,
        
        'articleThumb' => true,
        'enablePhotos' => true,
        'enableTags' => true,
        'enableShort' => true,
        'enableSource' => true,
        'shortMaxLength' => 255,

        'itemsInFolder' => false,
        'itemSlugImmutable' => false
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Articles',
            'ru' => 'Статьи',
        ],
        'icon' => 'pencil',
        'order_num' => 65,
    ];
}