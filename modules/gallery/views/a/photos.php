<?php
use yii\cms\widgets\Photos;

$this->title = $model->title;
?>

<?= $this->render('@cms/views/category/_menu') ?>

<?= Photos::widget(['model' => $model])?>