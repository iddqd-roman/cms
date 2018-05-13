<?php
namespace yii\cms\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\helpers\WebConsole;
use yii\cms\models\LoginForm;
use yii\cms\models\Setting;
use yii\helpers\FileHelper;

class SystemController extends \yii\cms\components\Controller
{
    public $rootActions = ['all'];

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        $result = WebConsole::migrate();

        Setting::set('cms_version', \yii\cms\AdminModule::VERSION);
        Yii::$app->cache->flush();

        return $this->render('update', ['result' => $result]);
    }

    public function actionFlushCache()
    {
        Yii::$app->cache->flush();
        $this->flash('success', Yii::t('cms', 'Cache flushed'));
        return $this->back();
    }

    public function actionClearAssets()
    {
        foreach(glob(Yii::$app->assetManager->basePath . DIRECTORY_SEPARATOR . '*') as $asset){
            if(is_link($asset)){
                unlink($asset);
            } elseif(is_dir($asset)){
                $this->deleteDir($asset);
            } else {
                unlink($asset);
            }
        }
        $this->flash('success', Yii::t('cms', 'Assets cleared'));
        return $this->back();
    }

    public function actionLogs()
    {
        $data = new ActiveDataProvider([
            'query' => LoginForm::find()->desc(),
        ]);

        return $this->render('logs', [
            'data' => $data
        ]);
    }

    private function deleteDir($directory)
    {
        $iterator = new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        return rmdir($directory);
    }
}