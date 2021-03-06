<?php
use yii\cms\modules\entity\EntityModule;
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>

<ul class="nav nav-tabs">
    <li <?= ($action === 'edit') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/items/edit', 'id' => $model->primaryKey]) ?>"><?= Yii::t('cms', 'Edit') ?></a></li>
    <?php if(EntityModule::setting('itemPhotos')) : ?>
        <li <?= ($action === 'photos') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/items/photos', 'id' => $model->primaryKey]) ?>"><span class="glyphicon glyphicon-camera"></span> <?= Yii::t('cms', 'Photos') ?></a></li>
    <?php endif; ?>
</ul>
<br>