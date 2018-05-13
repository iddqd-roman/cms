<?php
namespace yii\cms\modules\text\api;

use Yii;
use yii\cms\components\API;
use yii\cms\helpers\Data;
use yii\helpers\Url;
use yii\cms\modules\text\models\Text as TextModel;
use yii\helpers\Html;

/**
 * Text module API
 * @package yii\cms\modules\text\api
 *
 * @method static get(mixed $id_slug) Get text block by id or slug
 */
class Text extends API
{
    private $_texts = [];

    public function init()
    {
        parent::init();

        $this->_texts = Data::cache(TextModel::CACHE_KEY, 3600, function(){
            return TextModel::find()->asArray()->all();
        });
    }

    public function api_get($id_slug, $liveEditable = true)
    {
        if(($text = $this->findText($id_slug)) === null){
            return $this->notFound($id_slug);
        }
        $textContent = nl2br($text['text']);
        return ($liveEditable && LIVE_EDIT_ENABLED) ? API::liveEdit($textContent ? $textContent : '[' . Yii::t('cms/text/api', 'Empty text') . ']', Url::to(['/admin/text/a/edit/', 'id' => $text['id']])) : $textContent;
    }

    private function findText($id_slug)
    {
        foreach ($this->_texts as $item) {
            if($item['slug'] == $id_slug || $item['id'] == $id_slug){
                return $item;
            }
        }
        return null;
    }

    private function notFound($id_slug)
    {
        $text = '';

        if(IS_ROOT && preg_match(TextModel::$SLUG_PATTERN, $id_slug)){
            $text = Html::a(Yii::t('cms/text/api', 'Create text'), ['/admin/text/a/create', 'slug' => $id_slug], ['target' => '_blank']);
        }

        return $text;
    }
}