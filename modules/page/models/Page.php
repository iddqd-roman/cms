<?php
namespace yii\cms\modules\page\models;

use Yii;
use yii\cms\behaviors\CacheFlush;
use yii\cms\behaviors\JsonColumns;
use yii\cms\behaviors\SeoBehavior;
use yii\cms\behaviors\SlugBehavior;
use yii\cms\components\CategoryWithFieldsModel;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\cms\modules\page\PageModule;

class Page extends CategoryWithFieldsModel
{
    public static function tableName()
    {
        return 'cms_pages';
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            [['title', 'text'], 'trim'],
            ['title', 'string', 'max' => 128],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('cms', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            [['status', 'show_in_menu'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
            [['fields', 'data'], 'safe'],
            ['show_in_menu', 'default', 'value' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('cms', 'Title'),
            'text' => Yii::t('cms', 'Text'),
            'slug' => Yii::t('cms', 'Slug'),
            'show_in_menu' => Yii::t('cms/page', 'Show in menu'),
        ];
    }

    public function behaviors()
    {
        return [
            'cacheflush' => [
                'class' => CacheFlush::className(),
                'key' => [static::tableName().'_tree', static::tableName().'_flat']
            ],
            'seoBehavior' => SeoBehavior::className(),
            'sluggable' => [
                'class' => SlugBehavior::className(),
                'immutable' => PageModule::setting('slugImmutable')
            ],
            'nestedSets' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree'
            ],
            'jsonColumns' => [
                'class' => JsonColumns::className(),
                'columns' => ['fields', 'data']
            ],
        ];
    }
}