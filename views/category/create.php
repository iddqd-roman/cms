<?php
$this->title = Yii::t('cms', 'Create category');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model, 'parent' => $parent]) ?>