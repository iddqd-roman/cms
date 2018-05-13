<?php
namespace yii\cms\actions;

class ChangeStatusAction extends \yii\base\Action
{
    public $model;
    public $status;

    public function run($id)
    {
        $modelClass = $this->model ? $this->model : $this->controller->modelClass;
        if($this->status === null){
            $this->status = $this->id == 'off' ? 0 : 1;
        }

        if(($model = $modelClass::findOne($id))){
            $model->status = $this->status;
            $model->update();
        } else {
            $this->controller->error = Yii::t('cms', 'Not found');
        }

        return $this->controller->formatResponse(\Yii::t('cms', 'Status successfully changed'));
    }
}