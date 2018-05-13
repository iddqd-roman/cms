<?php
$this->title = Yii::t('cms/article', 'Create article');
?>
<?= $this->render('_menu', ['category' => $category]) ?>
<?= $this->render('_form', ['model' => $model, 'cats' => $cats]) ?>