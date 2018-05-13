<?php
$this->title = Yii::t('cms/entity', 'Create item');
?>
<?= $this->render('_menu', ['category' => $category]) ?>
<?= $this->render('_form', ['model' => $model, 'dataForm' => $dataForm, 'cats' => $cats]) ?>