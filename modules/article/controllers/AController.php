<?php
namespace yii\cms\modules\article\controllers;

use yii\cms\components\CategoryController;

class AController extends CategoryController
{
    /** @var string  */
    public $categoryClass = 'yii\cms\modules\article\models\Category';

    /** @var string  */
    public $moduleName = 'article';
}