<?php
namespace yii\cms\assets;

class FieldsTableAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@cms/assets/fields_table';
    public $css = [
        'fields.css',
    ];
    public $js = [
        'fields.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
