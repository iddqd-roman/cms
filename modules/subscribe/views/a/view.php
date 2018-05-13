<?php
$this->title = Yii::t('cms/subscribe', 'View subscribe history');
$this->registerCss('.subscribe-view dt{margin-bottom: 10px;}');
?>
<?= $this->render('_menu') ?>

<dl class="dl-horizontal subscribe-view">
    <dt><?= Yii::t('cms/subscribe', 'Subject') ?></dt>
    <dd><?= $model->subject ?></dd>

    <dt><?= Yii::t('cms', 'Date') ?></dt>
    <dd><?= Yii::$app->formatter->asDatetime($model->time, 'medium') ?></dd>

    <dt><?= Yii::t('cms/subscribe', 'Sent') ?></dt>
    <dd><?= $model->sent ?></dd>

    <dt><?= Yii::t('cms/subscribe', 'Body') ?></dt>
    <dd></dd>
</dl>
<?= $model->body ?>