<?php
$this->title = Yii::t('cms/page', 'Create page');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model, 'dataForm' => $dataForm, 'parent' => $parent]) ?>