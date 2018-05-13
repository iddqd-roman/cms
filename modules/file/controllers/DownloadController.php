<?php
namespace yii\cms\modules\file\controllers;

use Yii;
use yii\cms\helpers\Upload;
use yii\cms\modules\file\models\File;

class DownloadController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = File::findOne($id);
        if($model){
            $model->updateCounters(['downloads' => 1]);
            Yii::$app->response->sendFile(Upload::getAbsolutePath($model->file));
        }
        else{
            throw new \yii\web\NotFoundHttpException(Yii::t('cms/file/api', 'File not found'));
        }
    }
}
