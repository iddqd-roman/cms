<?php
use yii\cms\modules\faq\FaqModule;
use yii\cms\widgets\TagsInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'model-form']
]); ?>
<?php if(FaqModule::setting('questionHtmlEditor')) : ?>
    <?= $form->field($model, 'question')->widget(\yii\cms\widgets\Redactor::className()) ?>
<?php else : ?>
    <?= $form->field($model, 'question')->textarea(['rows' => 4]) ?>
<?php endif; ?>

<?php if(FaqModule::setting('answerHtmlEditor')) : ?>
    <?= $form->field($model, 'answer')->widget(\yii\cms\widgets\Redactor::className()) ?>
<?php else : ?>
    <?= $form->field($model, 'answer')->textarea(['rows' => 4]) ?>
<?php endif; ?>

<?php if(FaqModule::setting('enableTags')) : ?>
    <?= $form->field($model, 'tagNames')->widget(TagsInput::className()) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('cms','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>