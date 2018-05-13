<?php
namespace yii\cms\modules\file;

class FileModule extends \yii\cms\components\Module
{
    public $settings = [
        'slugImmutable' => false
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Files',
            'ru' => 'Файлы',
        ],
        'icon' => 'floppy-disk',
        'order_num' => 30,
    ];
}