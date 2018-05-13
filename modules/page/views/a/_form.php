<?php
use yii\cms\modules\page\models\Page;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\cms\widgets\SeoForm;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>

<?php if(!empty($parent)) : ?>
    <div class="form-group field-category-title required">
        <label for="category-parent" class="control-label"><?= Yii::t('cms/page', 'Parent page') ?></label>
        <select class="form-control" id="category-parent" name="parent">
            <option value="" class="smooth"><?= Yii::t('cms', 'No') ?></option>
            <?php foreach(Page::cats() as $node) : ?>
                <option
                    value="<?= $node->id ?>"
                    <?php if($parent == $node->id) echo 'SELECTED' ?>
                    style="padding-left: <?= $node['depth'] * 20 ?>px;"
                ><?= $node->title ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>

<?= $form->field($model, 'text')->widget(\yii\cms\widgets\Redactor::className()) ?>

<?= $dataForm ?>

<?= $form->field($model, 'show_in_menu')->checkbox() ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('cms','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>