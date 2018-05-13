<?php
$this->title = Yii::t('cms/subscribe', 'Create subscribe');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>