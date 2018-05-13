<?php
namespace yii\cms\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\actions\DeleteAction;
use yii\cms\components\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\cms\models\Setting;

class SettingsController extends Controller
{
    public $rootActions = ['create', 'delete'];
    public $modelClass = 'yii\cms\models\Setting';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms', 'Setting deleted')
            ]
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Setting::find()->where(['>=', 'visibility', IS_ROOT ? Setting::VISIBLE_ROOT : Setting::VISIBLE_ALL]),
        ]);
        Yii::$app->user->setReturnUrl('/admin/settings');

        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new Setting;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms', 'Setting created'));
                    return $this->redirect('/admin/settings');
                }
                else{
                    $this->flash('error', Yii::t('cms', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if($model->visibility < (IS_ROOT ? Setting::VISIBLE_ROOT : Setting::VISIBLE_ALL)){
            throw new ForbiddenHttpException();
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms', 'Setting updated'));
                }
                else{
                    $this->flash('error', Yii::t('cms', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }
}