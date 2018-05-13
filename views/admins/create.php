<?php
$this->title = Yii::t('cms', 'Create admin');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>