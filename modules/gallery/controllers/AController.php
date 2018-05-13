<?php
namespace yii\cms\modules\gallery\controllers;

use yii\cms\components\CategoryController;

class AController extends CategoryController
{
    public $categoryClass = 'yii\cms\modules\gallery\models\Category';
    public $moduleName = 'gallery';
    public $viewRoute = '/a/photos';

    public function actionPhotos($id)
    {
        return $this->render('photos', [
            'model' => $this->findCategory($id),
        ]);
    }
}