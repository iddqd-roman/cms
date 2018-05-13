<?php
namespace yii\cms\actions;

class DeleteAction extends \yii\base\Action
{
    public $model;
    public $successMessage = 'Deleted';

    public function run($id)
    {
        $modelClass = $this->model ? $this->model : $this->controller->modelClass;
        if(($model = $modelClass::findOne($id))){
            $model->delete();
        } else {
            $this->controller->error = \Yii::t('cms', 'Not found');
        }
        return $this->controller->formatResponse($this->successMessage);
    }
}