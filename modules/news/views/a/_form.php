<?php
use yii\cms\widgets\DateTimePicker;
use yii\cms\helpers\Image;
use yii\cms\widgets\TagsInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\cms\widgets\SeoForm;

$module = $this->context->module->id;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>
<?php if($this->context->module->settings['enableThumb']) : ?>
    <?php if($model->image_file) : ?>
        <a href="<?= $model->image ?>" class="fancybox"><img src="<?= Image::thumb($model->image_file, 240, 180) ?>"></a>
        <a href="<?= Url::to(['/admin/'.$module.'/a/clear-image', 'id' => $model->id]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('cms', 'Clear image')?>"><?= Yii::t('cms', 'Clear image')?></a>
    <?php endif; ?>
    <?= $form->field($model, 'image_file')->fileInput() ?>
<?php endif; ?>
<?php if($this->context->module->settings['enableShort']) : ?>
    <?= $form->field($model, 'short')->textarea() ?>
<?php endif; ?>
<?php if($this->context->module->settings['enableSource']) : ?>
    <?= $form->field($model, 'source')->textInput() ?>
<?php endif; ?>

<?= $form->field($model, 'text')->widget(\yii\cms\widgets\Redactor::className()) ?>
<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>

<?php if($this->context->module->settings['enableTags']) : ?>
    <?= $form->field($model, 'tagNames')->widget(TagsInput::className()) ?>
<?php endif; ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('cms', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
