<?php
$this->title = Yii::t('cms', 'Edit admin');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>