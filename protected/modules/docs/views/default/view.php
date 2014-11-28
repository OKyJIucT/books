<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    $model->title,
);
?>

<div class="col-md-12">
    <h2><?= $model->title; ?></h2>
    <h4><?= $model->title_en; ?></h4>
</div>

<div class="col-md-2 post">
    <img class="img-responsive mbottom" src="<?= $model->thumb ? '/thumbs' . Y::getDir($model->date) . $model->thumb : '/thubms/noimage.jpg'; ?>" />
</div>
<div class="col-md-10 form-horizontal">
    <div class="form-group">
        <label class="col-md-2 control-label">Автор:</label>
        <div class="col-md-10">
            <p class="form-control-static"><?= $model->author; ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Добавлено:</label>
        <div class="col-md-10">
            <p class="form-control-static"><?= date("d.m.Y", $model->date); ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Добавил:</label>
        <div class="col-md-10">
            <p class="form-control-static"><a href="<?= Y::url('/users/default/view', array('id' => $model->user->id)); ?>"><?= $model->user->email; ?></a></p>
        </div>
    </div>
    
    <?= $model->text; ?>

    <div class="clearfix"></div>

    <div class="btn-group mtop mbottom">
        <a href="<?= Y::url('/chapter/default/create', array('docs' => $model->id)); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Добавить главу</a>
        <?php if (Y::hasAccess('administrator')) : ?>
            <a href="<?= Y::url('/chapter/default/admin'); ?>" class="btn btn-warning"><i class="fa fa-cogs"></i> Управление</a>
        <?php endif; ?>   
    </div>

    <?php foreach ($model->chapters as $chapter) : ?>
        <h4>
            <a href="<?= Y::url('/chapter/default/view', array('id' => $chapter->id)); ?>"><?= $chapter->name . ' (' . $chapter->name_en . ')'; ?></a> Переведено: <?= Y::getProcess($chapter->id); ?> из <?= count($chapter->parts); ?>
        </h4>
    <?php endforeach; ?>

</div>


