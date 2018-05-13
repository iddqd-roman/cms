<?php
use yii\cms\models\Setting;
use yii\helpers\Url;

$this->title = Yii::t('cms', 'System');
?>
<?= $this->render('_menu') ?>

<h4><?= Yii::t('cms', 'Current version') ?>: <b><?= Setting::get('cms_version') ?></b>
    <?php if(\yii\cms\AdminModule::VERSION > floatval(Setting::get('cms_version'))) : ?>
        <a href="<?= Url::to(['/admin/system/update']) ?>" class="btn btn-success"><?= Yii::t('cms', 'Update') ?></a>
    <?php endif; ?>
</h4>

<br>

<p>
    <a href="<?= Url::to(['/admin/system/flush-cache']) ?>" class="btn btn-default"><i class="glyphicon glyphicon-flash"></i> <?= Yii::t('cms', 'Flush cache') ?></a>
</p>

<br>

<p>
    <a href="<?= Url::to(['/admin/system/clear-assets']) ?>" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i> <?= Yii::t('cms', 'Clear assets') ?></a>
</p>