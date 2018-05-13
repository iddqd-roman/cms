<?php
$this->title = Yii::t('cms/file', 'Edit file');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>