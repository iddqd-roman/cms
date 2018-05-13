<?php
namespace yii\cms\modules\article\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\cms\behaviors\ImageFile;
use yii\cms\behaviors\SeoBehavior;
use yii\cms\behaviors\SlugBehavior;
use yii\cms\behaviors\Taggable;
use yii\cms\models\Photo;
use yii\cms\modules\article\ArticleModule;
use yii\helpers\StringHelper;

class Item extends \yii\cms\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public static function tableName()
    {
        return 'cms_article_items';
    }

    public function rules()
    {
        return [
            [['text', 'title'], 'required'],
            [['title', 'short', 'source', 'text'], 'trim'],
            ['title', 'string', 'max' => 128],
            ['image_file', 'image'],
            [['category_id', 'views', 'time', 'status'], 'integer'],
            ['time', 'default', 'value' => time()],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('cms', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['tagNames', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('cms', 'Title'),
            'category_id' => Yii::t('cms', 'Category'),
            'text' => Yii::t('cms', 'Text'),
            'short' => Yii::t('cms/article', 'Short'),
            'source' => Yii::t('cms/article', 'Source'),
            'image_file' => Yii::t('cms', 'Image'),
            'time' => Yii::t('cms', 'Date'),
            'slug' => Yii::t('cms', 'Slug'),
            'tagNames' => Yii::t('cms', 'Tags'),
        ];
    }

    public function behaviors()
    {
        $behaviors = [
            'seoBehavior' => SeoBehavior::className(),
            'taggabble' => Taggable::className(),
            'sluggable' => [
                'class' => SlugBehavior::className(),
                'immutable' => ArticleModule::setting('itemSlugImmutable')
            ],
        ];
        if(ArticleModule::setting('articleThumb')){
            $behaviors['imageFileBehavior'] = ImageFile::className();
        }

        return $behaviors;
    }

    public function getCategory()
    {
        return Category::get($this->category_id);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'id'])->where(['class' => self::className()])->sort();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->short = StringHelper::truncate(ArticleModule::setting('enableShort') ? $this->short : strip_tags($this->text), ArticleModule::setting('shortMaxLength'));

            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach($this->getPhotos()->all() as $photo){
            $photo->delete();
        }
    }
}