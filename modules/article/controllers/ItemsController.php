<?php
namespace yii\cms\modules\article\controllers;

use Yii;
use yii\cms\actions\ChangeStatusAction;
use yii\cms\actions\ClearImageAction;
use yii\cms\actions\DeleteAction;
use yii\cms\actions\SortByDateAction;
use yii\cms\components\Controller;
use yii\cms\modules\article\ArticleModule;
use yii\cms\modules\article\models\Category;
use yii\cms\modules\article\models\Item;
use yii\widgets\ActiveForm;

class ItemsController extends Controller
{
    public $modelClass = 'yii\cms\modules\article\models\Item';
    public $categoryClass = 'yii\cms\modules\article\models\Category';

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'successMessage' => Yii::t('cms/article', 'Article deleted')
            ],
            'clear-image' => ClearImageAction::className(),
            'up' => [
                'class' => SortByDateAction::className(),
                'addititonalEquality' => ['category_id']
            ],
            'down' => [
                'class' => SortByDateAction::className(),
                'addititonalEquality' => ['category_id']
            ],
            'on' => ChangeStatusAction::className(),
            'off' => ChangeStatusAction::className(),
        ];
    }

    public function actionIndex($id)
    {
        return $this->render('index', [
            'category' => $this->findCategory($id)
        ]);
    }

    public function actionCreate($id)
    {
        $category = $this->findCategory($id);

        $model = new Item([
            'category_id' => $id,
            'time' => time()
        ]);

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else {
                if ($model->save()) {
                    $this->flash('success', Yii::t('cms/article', 'Article created'));
                    return $this->redirect(['/admin/'.$this->module->id.'/items/edit', 'id' => $model->primaryKey]);
                } else {
                    $this->flash('error', Yii::t('cms', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'category' => $category,
                'cats' => $this->getCats()
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
            else {
                if ($model->save()) {
                    $this->flash('success', Yii::t('cms/article', 'Article updated'));
                    return $this->redirect(['/admin/'.$this->module->id.'/items/edit', 'id' => $model->primaryKey]);
                } else {
                    $this->flash('error', Yii::t('cms', 'Update error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model,
                'cats' => $this->getCats()
            ]);
        }
    }

    public function actionPhotos($id)
    {
        return $this->render('photos', [
            'model' => $this->findModel($id),
        ]);
    }

    private function getCats()
    {
        $result = [];
        foreach(Category::cats() as $cat){
            if(!count($cat->children) || ArticleModule::setting('itemsInFolder')) {
                $result[$cat->id] = $cat->title;
            }
        }
        return $result;
    }


}