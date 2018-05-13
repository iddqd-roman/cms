<?php
namespace yii\cms\modules\text\models;

use Yii;
use yii\cms\behaviors\CacheFlush;

class Text extends \yii\cms\components\ActiveRecord
{
    const CACHE_KEY = 'cms_text';

    public static function tableName()
    {
        return 'cms_texts';
    }

    public function rules()
    {
        return [
            ['text', 'trim'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('cms', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['slug', 'unique']
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => Yii::t('cms', 'Text'),
            'slug' => Yii::t('cms', 'Slug'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className()
        ];
    }
}