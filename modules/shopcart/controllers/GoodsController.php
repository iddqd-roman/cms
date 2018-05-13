<?php
namespace yii\cms\modules\shopcart\controllers;

use Yii;
use yii\cms\actions\DeleteAction;
use yii\cms\components\Controller;
use yii\cms\modules\shopcart\models\Good;

class GoodsController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'model' => Good::className(),
                'successMessage' => Yii::t('cms/shopcart', 'Item deleted')
            ]
        ];
    }
}