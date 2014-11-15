<div class="col-md-6 post">
    <h2><a href="<?= Y::url('/docs/default/view', array('id' => $data->id)); ?>"><?= $data->title; ?></a></h2>
    <h4><?= $data->title_en; ?></h4>
    <div class="col-md-4">
        <img src="<?= $data->thumb ? '/thumbs' . Y::getDir($data->date) . $data->thumb : '/thubms/noimage.jpg'; ?>" style="width: 100%; max-width: 300px;" />
    </div>
    <div class="col-md-8 form-horizontal">
        <div class="form-group">
            <label class="col-xs-4 control-label">Автор:</label>
            <div class="col-xs-8">
                <p class="form-control-static"><?= $data->author; ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label">Добавлено:</label>
            <div class="col-xs-8">
                <p class="form-control-static"><?= date("d.m.Y", $data->date); ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 control-label">Добавил:</label>
            <div class="col-xs-8">
                <p class="form-control-static"><a href="<?= Y::url('/users/default/view', array('id' => $data->user->id)); ?>"><?= $data->user->email; ?></a></p>
            </div>
        </div>

        <div class="form-group">

            <div class="col-xs-12">
                <?= $data->text; ?>
            </div>
        </div>

        <div class="clearfix"></div>

        <a href="<?= Y::url('/docs/default/view', array('id' => $data->id)); ?>" class="btn btn-success pull-right">Подробней</a>

    </div>
</div>