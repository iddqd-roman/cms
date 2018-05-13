<?php
namespace yii\cms\controllers;

use yii\cms\models\Module;

class DefaultController extends \yii\cms\components\Controller
{
    public function actionIndex()
    {
        $notifications = Module::find()->where(['and', ['>', 'notice', 0], ['status' => Module::STATUS_ON]])->sort()->limit(4)->all();

        return $this->render('index', [
            'notifications' => $notifications
        ]);
    }

    public function actionLiveEdit($id)
    {
        \Yii::$app->session->set('cms_live_edit', $id);
        $this->back();
    }
}