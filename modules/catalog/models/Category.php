<?php
namespace yii\cms\modules\catalog\models;

use yii\cms\components\CategoryWithFieldsModel;

class Category extends CategoryWithFieldsModel
{
    public static function tableName()
    {
        return 'cms_catalog_categories';
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->sortDate();
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach($this->getItems()->all() as $item){
            $item->delete();
        }
    }
}