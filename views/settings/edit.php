<?php
$this->title = Yii::t('cms', 'Edit setting');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>