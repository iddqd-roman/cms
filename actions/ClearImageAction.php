<?php
namespace yii\cms\actions;

use Yii;

class ClearImageAction extends \yii\base\Action
{
    public $model;

    public function run($id)
    {
        $modelClass = $this->model ? $this->model : $this->controller->modelClass;
        $model = $modelClass::findOne($id);

        if($model === null){
            $this->controller->flash('error', Yii::t('cms', 'Not found'));
        }
        elseif($model->image_file){
            $model->image_file = '';
            if($model->update()){
                $this->controller->flash('success', Yii::t('cms', 'Image cleared'));
            } else {
                $this->controller->flash('error', Yii::t('cms', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->controller->back();
    }
}