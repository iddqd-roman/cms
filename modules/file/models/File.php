<?php
namespace yii\cms\modules\file\models;

use Yii;
use yii\cms\behaviors\SeoBehavior;
use yii\cms\behaviors\SlugBehavior;
use yii\cms\behaviors\SortableModel;
use yii\cms\helpers\Upload;
use yii\cms\modules\file\FileModule;

class File extends \yii\cms\components\ActiveRecord
{
    public static function tableName()
    {
        return 'cms_files';
    }

    public function rules()
    {
        return [
            ['file', 'file'],
            ['title', 'required'],
            ['title', 'string', 'max' => 128],
            ['title', 'trim'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('cms', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            [['downloads', 'size'], 'integer'],
            ['time', 'default', 'value' => time()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('cms', 'Title'),
            'file' => Yii::t('cms', 'File'),
            'slug' => Yii::t('cms', 'Slug')
        ];
    }

    public function behaviors()
    {
        return [
            SortableModel::className(),
            'seoBehavior' => SeoBehavior::className(),
            'sluggable' => [
                'class' => SlugBehavior::className(),
                'immutable' => FileModule::setting('slugImmutable')
            ]
        ];
    }

    public function getLink()
    {
        return Upload::getFileUrl($this->file);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->file !== $this->oldAttributes['file']){
                Upload::delete($this->oldAttributes['file']);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        Upload::delete($this->file);
    }
}