<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\cms\widgets\SeoForm;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('cms','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>