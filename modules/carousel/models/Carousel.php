<?php
namespace yii\cms\modules\carousel\models;

use Yii;
use yii\cms\behaviors\CacheFlush;
use yii\cms\behaviors\ImageFile;
use yii\cms\behaviors\SortableModel;

class Carousel extends \yii\cms\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    const CACHE_KEY = 'cms_carousel';

    public static function tableName()
    {
        return 'cms_carousel';
    }

    public function rules()
    {
        return [
            ['image_file', 'required', 'on' => 'create'],
            ['image_file', 'image'],
            [['title', 'text', 'link'], 'trim'],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image_file' => Yii::t('cms', 'Image'),
            'link' =>  Yii::t('cms', 'Link'),
            'title' => Yii::t('cms', 'Title'),
            'text' => Yii::t('cms', 'Text'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className(),
            SortableModel::className(),
            ImageFile::className()
        ];
    }
}