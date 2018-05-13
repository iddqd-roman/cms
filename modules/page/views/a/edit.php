<?php
$this->title = Yii::t('cms/page', 'Edit page');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_submenu', ['model' => $model]); ?>
<?= $this->render('_form', ['model' => $model, 'dataForm' => $dataForm]) ?>