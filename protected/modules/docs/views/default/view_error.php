<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    $model->title,
);
?>



<div class="col-lg-12">
    <h2><?= $model->title; ?> <?php if ($model->type) echo '<span class="fa fa-lock text-danger" data-toggle="tooltip" data-placement="right" data-original-title="Приватный документ"></span>'; ?></h2>
    <h4><?= $model->title_en; ?></h4>
</div>

<div class="col-lg-2 post">
    <img class="img-responsive mbottom" src="<?= $model->thumb ? '/thumbs' . Y::getDir($model->date) . $model->thumb : '/thubms/noimage.jpg'; ?>" />
</div>
<div class="col-lg-10 form-horizontal">
    <div class="form-group">
        <label class="col-lg-3 control-label">Автор:</label>
        <div class="col-lg-9">
            <p class="form-control-static"><?= $model->author; ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Добавлено:</label>
        <div class="col-lg-9">
            <p class="form-control-static"><?= date("d.m.Y", $model->date); ?></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Добавил:</label>
        <div class="col-lg-9">
            <p class="form-control-static"><a href="<?= Y::url('/users/default/view', array('id' => $model->user->id)); ?>"><?= $model->user->username; ?></a></p>
        </div>
    </div>

    <?= $model->text; ?>

    <div class="clearfix"></div>

    <div class="btn-group mtop mbottom">
        <?php
        echo CHtml::form('', 'post', array('class' => 'translate'));
        echo '<div class="btn btn-danger"><i class="fa fa-lock"></i> Нет доступа к данному документу</div> ';

        if ($access['exist']) {
            echo '<div class="btn btn-info"> Заявка отправлена</div> ';
        } else {
            echo CHtml::ajaxButton('Запросить доступ', '/access/getAccess', array(
                'type' => 'POST',
                'data' => 'docs_id=' . $model->id,
                'success' => 'js:function(data){
                    $(".getAccess").val("Заявка отправлена").removeClass("btn-warning").addClass("btn-info");
                }'
                    ), array(
                'class' => 'btn btn-warning getAccess mleft',
                'name' => 'save',
                    )
            );
        }

        echo CHtml::endForm();
        ?>

    </div>


</div>


