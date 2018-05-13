<?php
namespace yii\cms\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\actions\DeleteAction;
use yii\widgets\ActiveForm;
use yii\cms\models\Admin;

class AdminsController extends \yii\cms\components\Controller
{
    public $rootActions = 'all';
    public $modelClass = 'yii\cms\models\Admin';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms', 'Admin deleted')
            ]
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Admin::find()->desc(),
        ]);
        Yii::$app->user->setReturnUrl(['/admin/admins']);

        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new Admin;
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->save()) {
                    $this->flash('success', Yii::t('cms', 'Admin created'));
                    return $this->redirect(['/admin/admins']);
                } else {
                    $this->flash('error', Yii::t('cms', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                if ($model->save()) {
                    $this->flash('success', Yii::t('cms', 'Admin updated'));
                } else {
                    $this->flash('error', Yii::t('cms', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        } else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }
}