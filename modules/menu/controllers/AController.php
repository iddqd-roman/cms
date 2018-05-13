<?php
namespace yii\cms\modules\menu\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\cms\actions\DeleteAction;
use yii\cms\modules\menu\models\Menu;
use yii\widgets\ActiveForm;
use yii\cms\components\Controller;
use yii\cms\actions\ChangeStatusAction;

class AController extends Controller
{
    public $modelClass = 'yii\cms\modules\menu\models\Menu';
    public $rootActions = ['create', 'delete'];

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms/menu', 'Menu deleted')
            ],
            'on' => ChangeStatusAction::className(),
            'off' => ChangeStatusAction::className(),
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Menu::find()
        ]);
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate($slug = null)
    {
        $model = new Menu;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms/menu', 'Menu created'));
                    return $this->redirect(['/admin/'.$this->module->id.'/a/edit', 'id' => $model->primaryKey]);
                }
                else{
                    $this->flash('error', Yii::t('cms', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            if($slug) $model->slug = $slug;

            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        //Сохранение информации о меню
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('cms/menu', 'Menu updated'));
                }
                else{
                    $this->flash('error', Yii::t('cms', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->redirect(['/admin/'.$this->module->id]);
            }
        }

        //Сохранение элементов меню
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            switch (true) {
                case Yii::$app->request->isGet :
                    return ['success' => true, 'menu' => $model->items];
                case Yii::$app->request->post('update'):
                    $model->items = Yii::$app->request->post('menu');
                    return $model->save() ? ['success' => true] : ['success' => false];
                default:
                    return ['success' => false];
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }
}