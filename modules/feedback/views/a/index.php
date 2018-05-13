<?php
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\cms\modules\feedback\models\Feedback;

$this->title = Yii::t('cms/feedback', 'Feedback');
$module = $this->context->module->id;
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="50">#</th>
                <th><?= Yii::t('cms', $this->context->module->settings['enableTitle'] ? 'Title' : 'Text') ?></th>
                <th width="150"><?= Yii::t('cms', 'Date') ?></th>
                <th width="100"><?= Yii::t('cms/feedback', 'Answer') ?></th>
                <th width="30"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data->models as $item) : ?>
            <tr>
                <td><?= $item->primaryKey ?></td>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/view', 'id' => $item->primaryKey]) ?>"><?= $item->name . ' ' . ($item->phone ? $item->phone : $item->email) ?></a></td>
                <td><?= Yii::$app->formatter->asDatetime($item->time, 'short') ?></td>
                <td>
                    <?php if($item->status == Feedback::STATUS_ANSWERED) : ?>
                        <span class="text-success"><?= Yii::t('cms', 'Yes') ?></span>
                    <?php else : ?>
                        <span class="text-danger"><?= Yii::t('cms', 'No') ?></span>
                    <?php endif; ?>
                </td>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('cms', 'Delete item') ?>"></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('cms', 'No records found') ?></p>
<?php endif; ?>