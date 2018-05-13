<?php
$this->title = Yii::t('cms/news', 'Create news');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>