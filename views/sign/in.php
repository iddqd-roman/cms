<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$asset = \yii\cms\assets\EmptyAsset::register($this);
$this->title = Yii::t('cms', 'Sign in');
?>
<div class="container">
    <div id="wrapper" class="col-md-4 col-md-offset-4 vertical-align-parent">
        <div class="vertical-align-child">
            <div class="panel">
                <div class="panel-heading text-center">
                    <?= Yii::t('cms', 'Sign in') ?>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
                        ]
                    ])
                    ?>
                        <?= $form->field($model, 'username')->textInput(['class'=>'form-control', 'placeholder'=>Yii::t('cms', 'Username')]) ?>
                        <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'placeholder'=>Yii::t('cms', 'Password')]) ?>
                        <?=Html::submitButton(Yii::t('cms', 'Login'), ['class'=>'btn btn-lg btn-primary btn-block']) ?>
                    <?php ActiveForm::end(); ?>
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
