<div class="col-md-4 post">
    <h3>
        <a href="<?= Y::url('/docs/default/view', array('id' => $data->id)); ?>"><?= $data->title; ?></a>
        <?php if($data->type) echo '<span class="fa fa-lock text-danger" data-toggle="tooltip" data-placement="right" data-original-title="Приватный документ"></span>'; ?>
    </h3>
    <h4><?= $data->title_en; ?></h4>
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive mbottom" src="<?= $data->thumb ? '/thumbs' . Y::getDir($data->date) . $data->thumb : '/thubms/noimage.jpg'; ?>" />
        </div>
        <div class="col-md-8 form-horizontal">
            <div class="form-group">
                <label class="col-md-4 control-label">Автор:</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?= $data->author; ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Добавлено:</label>
                <div class="col-md-8">
                    <p class="form-control-static"><?= date("d.m.Y", $data->date); ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Добавил:</label>
                <div class="col-md-8">
                    <p class="form-control-static"><a href="<?= Y::url('/users/default/view', array('id' => $data->user->id)); ?>"><?= $data->user->username; ?></a></p>
                </div>
            </div>
        </div>
    </div>


    <?= Y::cut($data->text); ?>
    <div class="clearfix"></div>

    <a href="<?= Y::url('/docs/default/view', array('id' => $data->id)); ?>" class="btn btn-success pull-right mtop">Подробней</a>


</div>