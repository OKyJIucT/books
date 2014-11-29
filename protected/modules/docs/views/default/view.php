<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    $model->title,
);
?>



<div class="col-md-12">
    <h2><?= $model->title; ?> <?php if ($model->type) echo '<span class="fa fa-lock text-danger" data-toggle="tooltip" data-placement="right" data-original-title="Приватный документ"></span>'; ?></h2>
    <h4><?= $model->title_en; ?></h4>
</div>

<div class="col-md-2 post">
    <img class="img-responsive mbottom" src="<?= $model->thumb ? '/thumbs' . Y::getDir($model->date) . $model->thumb : '/thubms/noimage.jpg'; ?>" />
</div>
<div class="col-md-6 form-horizontal">
    <div class="form-group">
        <label class="col-md-3 control-label">Автор:</label>
        <div class="col-md-9">
            <p class="form-control-static"><?= $model->author; ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Добавлено:</label>
        <div class="col-md-9">
            <p class="form-control-static"><?= date("d.m.Y", $model->date); ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Добавил:</label>
        <div class="col-md-9">
            <p class="form-control-static"><a href="<?= Y::url('/users/default/view', array('id' => $model->user->id)); ?>"><?= $model->user->username; ?></a></p>
        </div>
    </div>

    <?= $model->text; ?>

    <div class="clearfix"></div>

    <div class="btn-group mtop mbottom">
        <a href="<?= Y::url('/chapter/default/create', array('docs' => $model->id)); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Добавить главу</a>
        <?php if ($access['role'] == 1 || Y::hasAccess('administrator')) : ?>
            <a href="<?= Y::url('/docs/default/setting', array('id' => $model->id)); ?>" class="btn btn-warning"><i class="fa fa-cogs"></i> Настройки</a>
        <?php endif; ?>   
    </div>

    <?php foreach ($model->chapters as $chapter) : ?>
        <h4>
            <a href="<?= Y::url('/chapter/default/view', array('id' => $chapter->id)); ?>"><?= $chapter->name . ' (' . $chapter->name_en . ')'; ?></a> Переведено: <?= Y::getProcess($chapter->id); ?> из <?= count($chapter->parts); ?>
        </h4>
    <?php endforeach; ?>

</div>
<div class="col-md-4">
    <?php
    if ($model->type == 0) {
        echo 'Данный документ является публичным - доступ к переводу и добавлению глав есть у каждого пользователя.';
    } else {
        $users = array();
        foreach ($model->accesses as $user) {
            $users[$user->role][$user->user->id] = $user->user->username;
        }

        foreach ($users as $key => $group) {
            switch ($key) {
                case 1:
                    echo '<h4>Владелец</h4>';
                    foreach ($group as $key => $user) {
                        echo '<p><a href="' . Y::url('/users/default/view', array('id' => $key)) . '">' . $user . '</a></p>';
                    }
                    break;

                case 2:
                    echo '<h4>Редакторы</h4>';
                    foreach ($group as $key => $user) {
                        echo '<p><a href="' . Y::url('/users/default/view', array('id' => $key)) . '">' . $user . '</a></p>';
                    }
                    break;

                case 3:
                    echo '<h4>Переводчики</h4>';
                    foreach ($group as $key => $user) {
                        echo '<p><a href="' . Y::url('/users/default/view', array('id' => $key)) . '">' . $user . '</a></p>';
                    }
                    break;
            }
        }
    }
    ?>

</div>

