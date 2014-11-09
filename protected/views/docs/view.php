<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    $model->title,
);
?>

<div class="col-md-12">
    <div class="btn-group">
        <a href="/docs" class="btn btn-default"><i class="fa fa-list"></i> Список</a>
        <a href="/docs/create" class="btn btn-default"><i class="fa fa-plus"></i> Добавить</a>
        <?php if (Y::hasAccess('administrator')) : ?>
            <a href="/docs/update/.<?= $model->id; ?>" class="btn btn-default"><i class="fa fa-cogs"></i> Изменить</a>
            <a href="/docs/admin" class="btn btn-default"><i class="fa fa-cogs"></i> Управление</a>
        <?php endif; ?>   
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 post">
        <h2><?= $model->title; ?></h2>
        <h4><?= $model->title_en; ?></h4>
        <div class="col-md-3">
            <img src="<?= $model->thumb ? '/thumbs' . Y::getDir($model->date) . $model->thumb : '/thubms/noimage.jpg'; ?>" style="width: 100%; max-width: 300px;" />
        </div>
        <div class="col-md-3">
            <div class="col-xs-5">Автор:</div>
            <div class="col-xs-7"><?= $model->author; ?></div>

            <div class="col-xs-5">Добавлено:</div>
            <div class="col-xs-7"><?= date("d.m.Y", $model->date); ?></div>

            <div class="col-xs-5">Добавил:</div>
            <div class="col-xs-7"><a href="<?= Y::url('users/view', array('id' => $model->user->id)); ?>"><?= $model->user->email; ?></a></div>
        </div>
        <div class="col-md-6">
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
            <?= $model->text; ?><br />
        </div>
    </div>
    <div class="clearfix"></div>

    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
    <?= $model->text; ?><br />
</div>

