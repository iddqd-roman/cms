<?php
namespace yii\cms\modules\menu\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\cms\behaviors\CacheFlush;
use yii\cms\behaviors\SortableModel;
use yii\cms\modules\menu\MenuModule;

class Menu extends \yii\cms\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    const CACHE_KEY = 'cms_menu';

    public static function tableName()
    {
        return 'cms_menu';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 128],
            [['title', 'items'], 'trim'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('cms', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['items', 'default', 'value' => '[]'],
            ['slug', 'unique'],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('cms', 'Title'),
            'slug' => Yii::t('cms', 'Slug'),
            'items' => Yii::t('cms', 'Items'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => MenuModule::setting('slugImmutable')
            ],
        ];
    }
}