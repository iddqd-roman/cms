<?php
namespace yii\cms\modules\entity\controllers;

use yii\cms\components\CategoryController;
use yii\cms\modules\entity\EntityModule;
use yii\cms\modules\entity\models\Category;

class AController extends CategoryController
{
    public $categoryClass = 'yii\cms\modules\entity\models\Category';
    public $modelClass = 'yii\cms\modules\entity\models\Item';
    public $moduleName = 'entity';

    public function getSameCats($cat)
    {
        $result = [];
        $fieldsHash = md5(json_encode($cat->fields));
        foreach(Category::cats() as $cat){
            if(md5(json_encode($cat->fields)) == $fieldsHash && (!count($cat->children) || EntityModule::setting('itemsInFolder'))) {
                $result[$cat->id] = $cat->title;
            }
        }
        return $result;
    }
}