<?php
namespace yii\cms\modules\article\api;

use Yii;
use yii\cms\components\API;
use yii\helpers\Html;
use yii\helpers\Url;

class PhotoObject extends \yii\cms\components\ApiObject
{
    public $description;

    public function box($width, $height){
        $img = Html::img($this->thumb($width, $height));
        $a = Html::a($img, $this->image, [
            'class' => 'cms-box',
            'rel' => 'article-'.$this->model->item_id,
            'title' => $this->description
        ]);
        return LIVE_EDIT_ENABLED ? API::liveEdit($a, $this->editLink) : $a;
    }

    public function getEditLink(){
        return Url::to(['/admin/article/items/photos', 'id' => $this->model->item_id]).'#photo-'.$this->id;
    }
}