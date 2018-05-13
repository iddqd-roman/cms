<?php
namespace yii\cms\modules\entity\models;

use yii\cms\components\CategoryWithFieldsModel;

class Category extends CategoryWithFieldsModel
{
    public static function tableName()
    {
        return 'cms_entity_categories';
    }

    public function rules()
    {
        return array_merge([
            ['cache', 'integer'],
        ], parent::rules());
    }

    public function attributeLabels()
    {
        return array_merge(['cache' => \Yii::t('cms', 'Cache')], parent::attributeLabels());
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->sort();
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach($this->getItems()->all() as $item){
            $item->delete();
        }
    }

    public static function getCacheName($category_id)
    {
        return 'entity' . $category_id;
    }
}