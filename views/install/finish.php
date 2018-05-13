<?php
use yii\helpers\Url;

$asset = \yii\cms\assets\EmptyAsset::register($this);;

$this->title = Yii::t('cms/install', 'Installation completed');
?>
<div class="container">
    <div id="wrapper" class="col-md-6 col-md-offset-3 vertical-align-parent">
        <div class="vertical-align-child">
            <div class="panel">
                <div class="panel-heading text-center">
                    <?= Yii::t('cms/install', 'Installation completed') ?>
                </div>
                <div class="panel-body text-center">
                    <a href="<?= Url::to(['/admin']) ?>">Go to control panel</a>
                </div>
            </div>
            <div class="text-center">
                <a class="logo" href="http://cmscms.com" target="_blank" title="cmsCMS homepage">
                    <img src="<?= $asset->baseUrl ?>/img/logo_20.png">cmsCMS
                </a>
            </div>
        </div>
    </div>
</div>
