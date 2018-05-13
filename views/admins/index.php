<?php
use yii\helpers\Url;

$this->title = Yii::t('cms', 'Admins');
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="50">#</th>
            <th><?= Yii::t('cms', 'Username') ?></th>
            <th width="30"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data->models as $admin) : ?>
            <tr>
                <td><?= $admin->id ?></td>
                <td><a href="<?= Url::to(['/admin/admins/edit', 'id' => $admin->id]) ?>"><?= $admin->username ?></a></td>
                <td><a href="<?= Url::to(['/admin/admins/delete', 'id' => $admin->id]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('cms', 'Delete item') ?>"></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <?= yii\widgets\LinkPager::widget([
            'pagination' => $data->pagination
        ]) ?>
    </table>
<?php else : ?>
    <p><?= Yii::t('cms', 'No records found') ?></p>
<?php endif; ?>