<?php
$this->title = Yii::t('cms/text', 'Edit text');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>