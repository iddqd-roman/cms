<?php
namespace yii\cms\modules\faq\models;

use Yii;
use yii\cms\behaviors\CacheFlush;
use yii\cms\behaviors\SortableModel;
use yii\cms\behaviors\Taggable;

class Faq extends \yii\cms\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    const CACHE_KEY = 'cms_faq';

    public static function tableName()
    {
        return 'cms_faq';
    }

    public function rules()
    {
        return [
            [['question','answer'], 'required'],
            [['question', 'answer'], 'trim'],
            ['tagNames', 'safe'],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => Yii::t('cms/faq', 'Question'),
            'answer' => Yii::t('cms/faq', 'Answer'),
            'tagNames' => Yii::t('cms', 'Tags'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className(),
            SortableModel::className(),
            'taggabble' => Taggable::className(),
        ];
    }
}