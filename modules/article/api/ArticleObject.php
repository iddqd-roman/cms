<?php
namespace yii\cms\modules\article\api;

use Yii;
use yii\cms\components\API;
use yii\cms\models\Photo;
use yii\cms\modules\article\models\Item;
use yii\helpers\Url;

class ArticleObject extends \yii\cms\components\ApiObject
{
    /** @var  string */
    public $slug;

    /** @var  string */
    public $source;

    public $image;

    public $views;

    public $time;

    /** @var  int */
    public $category_id;

    private $_photos;

    public function getTitle($liveEditable = true){
        return ($liveEditable && LIVE_EDIT_ENABLED) ? API::liveEdit($this->model->title, $this->getEditLink()) : $this->model->title;
    }

    public function getShort(){
        return LIVE_EDIT_ENABLED ? API::liveEdit($this->model->short, $this->getEditLink()) : $this->model->short;
    }

    public function getText(){
        return LIVE_EDIT_ENABLED ? API::liveEdit($this->model->text, $this->getEditLink(), 'div') : $this->model->text;
    }

    public function getCat(){
        return Article::cat($this->category_id);
    }

    public function getTags(){
        return $this->model->tagsArray;
    }

    public function getDate(){
        return Yii::$app->formatter->asDate($this->time);
    }

    public function getPhotos()
    {
        if(!$this->_photos){
            $this->_photos = [];

            foreach(Photo::find()->where(['class' => Item::className(), 'item_id' => $this->id])->sort()->all() as $model){
                $this->_photos[] = new PhotoObject($model);
            }
        }
        return $this->_photos;
    }

    public function getEditLink(){
        return Url::to(['/admin/article/items/edit/', 'id' => $this->id]);
    }

    /**
     * Return max length chars from source
     * If $length == 0, return without truncate
     * @param int $length
     * @return bool|string
     */
    public function getSource($length = 0){
        if ($length){
            return substr($this->source, 0, $length);
        }
        return $this->source;
    }
}