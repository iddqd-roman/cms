<?php
$this->title = Yii::t('cms', 'Fields');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_submenu', ['model' => $model]); ?>
<br>
<?= \yii\cms\widgets\FieldsTable::widget(['model' => $model]) ?>