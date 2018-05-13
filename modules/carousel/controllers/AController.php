<?php
namespace yii\cms\modules\carousel\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\actions\ChangeStatusAction;
use yii\cms\actions\DeleteAction;
use yii\cms\actions\SortByNumAction;
use yii\widgets\ActiveForm;
use yii\cms\components\Controller;
use yii\cms\modules\carousel\models\Carousel;

class AController extends Controller
{
    public $modelClass = 'yii\cms\modules\carousel\models\Carousel';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms/carousel', 'Carousel item deleted')
            ],
            'up' => SortByNumAction::className(),
            'down' => SortByNumAction::className(),
            'on' => ChangeStatusAction::className(),
            'off' => ChangeStatusAction::className(),
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Carousel::find()->sort(),
        ]);
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new Carousel;
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                $model->status = Carousel::STATUS_ON;
                if($model->save()){
                    $this->flash('success', Yii::t('cms/carousel', 'Carousel created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
                }
                else{
                    $this->flash('error', Yii::t('cms', 'Create error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
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

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms/carousel', 'Carousel updated'));
                }
                else{
                    $this->flash('error', Yii::t('cms/carousel','Update error. {0}', $model->formatErrors()));
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