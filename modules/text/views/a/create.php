<?php
$this->title = Yii::t('cms/text', 'Create text');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>