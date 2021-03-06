<?php
use yii\helpers\Url;

$this->title = Yii::t('cms/text', 'Texts');

$module = $this->context->module->id;
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th width="50">#</th>
                <th><?= Yii::t('cms', 'Text') ?></th>
                <?php if(IS_ROOT) : ?>
                    <th><?= Yii::t('cms', 'Slug') ?></th>
                    <th width="30"></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data->models as $item) : ?>
            <tr>
                <td><?= $item->primaryKey ?></td>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->primaryKey]) ?>"><?= ($item->text ? $item->text : '[' . Yii::t('cms/text', 'Empty text') . ']') ?></a></td>
                <?php if(IS_ROOT) : ?>
                    <td><?= $item->slug ?></td>
                    <td><a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('cms', 'Delete item') ?>"></a></td>
                <?php endif; ?>
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