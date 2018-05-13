<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'enableClientValidation' => true
]); ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'body')->widget(\yii\cms\widgets\Redactor::className()) ?>
<?= Html::submitButton(Yii::t('cms', 'Send'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>