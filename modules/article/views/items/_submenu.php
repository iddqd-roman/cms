<?php
use yii\cms\modules\article\ArticleModule;
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>

<ul class="nav nav-tabs">
    <li <?= ($action === 'edit') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/items/edit', 'id' => $model->primaryKey]) ?>"><?= Yii::t('cms/article', 'Edit article') ?></a></li>
    <?php if(ArticleModule::setting('enablePhotos')) : ?>
        <li <?= ($action === 'photos') ? 'class="active"' : '' ?>><a href="<?= Url::to(['/admin/'.$module.'/items/photos', 'id' => $model->primaryKey]) ?>"><span class="glyphicon glyphicon-camera"></span> <?= Yii::t('cms', 'Photos') ?></a></li>
    <?php endif; ?>
</ul>
<br>