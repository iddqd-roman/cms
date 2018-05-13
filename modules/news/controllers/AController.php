<?php
namespace yii\cms\modules\news\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\actions\ChangeStatusAction;
use yii\cms\actions\ClearImageAction;
use yii\cms\actions\DeleteAction;
use yii\cms\actions\SortByDateAction;
use yii\widgets\ActiveForm;
use yii\cms\components\Controller;
use yii\cms\modules\news\models\News;

class AController extends Controller
{
    public $modelClass = 'yii\cms\modules\news\models\News';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms/news', 'News deleted')
            ],
            'clear-image' => ClearImageAction::className(),
            'up' => SortByDateAction::className(),
            'down' => SortByDateAction::className(),
            'on' => ChangeStatusAction::className(),
            'off' => ChangeStatusAction::className(),
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => News::find()->sortDate(),
        ]);

        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new News;
        $model->time = time();

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms/news', 'News created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
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

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms/news', 'News updated'));
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

    public function actionPhotos($id)
    {
        return $this->render('photos', [
            'model' => $this->findModel($id),
        ]);
    }
}