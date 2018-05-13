<?php
namespace yii\cms\modules\article\models;

class Category extends \yii\cms\components\CategoryModel
{
    public static function tableName()
    {
        return 'cms_article_categories';
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->sortDate();
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach ($this->getItems()->all() as $item) {
            $item->delete();
        }
    }
}