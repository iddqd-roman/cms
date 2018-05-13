<?php
namespace yii\cms\modules\catalog\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\cms\behaviors\SeoBehavior;
use yii\cms\behaviors\SortableModel;
use yii\cms\models\Photo;

class ItemData extends \yii\cms\components\ActiveRecord
{

    public static function tableName()
    {
        return 'cms_catalog_item_data';
    }
}