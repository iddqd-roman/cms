<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\cms\assets\FrontendAsset;
use yii\cms\models\Setting;

$position = Setting::get('toolbar_position');
if ($position === 'hide') {
    return;
}
$asset = FrontendAsset::register($this);
$position = $position === 'bottom' ? 'bottom' : 'top';
$this->registerCss('body {padding-'.$position.': 50px;}');
?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<nav id="cms-navbar">
    <div class="cms-container">
        <a href="<?= Url::to(['/admin']) ?>" class="pull-left"><span class="glyphicon glyphicon-arrow-left"></span> <?= Yii::t('cms', 'Control Panel') ?></a>
        <div class="live-edit-label pull-left">
            <i class="glyphicon glyphicon-pencil"></i>
            <?= Yii::t('cms', 'Live edit') ?>
        </div>
        <div class="live-edit-checkbox pull-left">
            <?= Html::checkbox('', LIVE_EDIT_ENABLED, ['data-link' => Url::to(['/admin/default/live-edit'])]) ?>
        </div>
        <a href="<?= Url::to(['/admin/sign/out']) ?>" class="pull-right"><span class="glyphicon glyphicon-log-out"></span> <?= Yii::t('cms', 'Logout') ?></a></li>
    </div>
</nav>