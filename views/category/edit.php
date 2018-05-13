<?php
$this->title = Yii::t('cms', 'Edit category');
?>
<?= $this->render('_menu') ?>

<?php if($model instanceof \yii\cms\components\CategoryWithFieldsModel) echo $this->render('_submenu', ['model' => $model]); ?>
<?= $this->render('_form', ['model' => $model]) ?>