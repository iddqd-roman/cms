<?php
$this->title = Yii::t('cms/menu', 'Create menu');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>