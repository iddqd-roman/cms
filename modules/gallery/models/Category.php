<?php
namespace yii\cms\modules\gallery\models;

use yii\cms\models\Photo;

class Category extends \yii\cms\components\CategoryModel
{
    public static function tableName()
    {
        return 'cms_gallery_categories';
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'id'])->where(['class' => self::className()])->sort();
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach($this->getPhotos()->all() as $photo){
            $photo->delete();
        }
    }
}