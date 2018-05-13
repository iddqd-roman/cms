<?php
namespace yii\cms\modules\catalog\controllers;

use yii\cms\components\CategoryController;

class AController extends CategoryController
{
    public $categoryClass = 'yii\cms\modules\catalog\models\Category';
    public $modelClass = 'yii\cms\modules\catalog\models\Item';
    public $moduleName = 'catalog';
}