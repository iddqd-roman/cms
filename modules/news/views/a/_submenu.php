<?php
use yii\cms\modules\news\NewsModule;
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>

<ul class="nav nav-tabs">
    <li <?= ($action === 'edit') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $model->primaryKey]) ?>"><?= Yii::t('cms/news', 'Edit news') ?></a></li>
    <?php if(NewsModule::setting('enablePhotos')) : ?>
        <li <?= ($action === 'photos') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/a/photos', 'id' => $model->primaryKey]) ?>"><span class="glyphicon glyphicon-camera"></span> <?= Yii::t('cms', 'Photos') ?></a></li>
    <?php endif; ?>
</ul>
<br>