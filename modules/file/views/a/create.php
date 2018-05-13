<?php
$this->title = Yii::t('cms/file', 'Create file');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>