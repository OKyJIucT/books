<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    $model->title => Y::url('/docs/default/view', array('id' => $model->id)),
    'Настройки'
);
?>

<div class="col-lg-12">
    <h2><?= $model->title; ?> <?php if ($model->type) echo '<span class="fa fa-lock text-danger" data-toggle="tooltip" data-placement="right" data-original-title="Приватный документ"></span>'; ?></h2>
    <h4><?= $model->title_en; ?></h4>
</div>

<div class="col-lg-2 post">
    <img class="img-responsive mbottom" src="<?= $model->thumb ? '/thumbs' . Y::getDir($model->date) . $model->thumb : '/thubms/noimage.jpg'; ?>" />
</div>
<div class="col-lg-6 form-horizontal">
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

    <div class="form-group">
        <label class="col-lg-3 control-label">Тип документа:</label>
        <div class="col-lg-9">
            <?php
            echo CHtml::form('', 'post', array('class' => 'translate'));

            if ($model->type == 1) {
                $label = 'Приватный. Изменить на публичный';
                $newLabel = 'Публичный. Изменить на приватный';
                $class = 'btn-danger';
            } else {
                $label = 'Публичный. Изменить на приватный';
                $newLabel = 'Приватный. Изменить на публичный';
                $class = 'btn-success';
            }

            echo CHtml::ajaxButton($label, '/docs/changeType', array(
                'type' => 'POST',
                'data' => 'docs_id=' . $model->id,
                'success' => 'js:function(data){
                    $(".change").toggleClass("btn-danger").toggleClass("btn-success");
                    $(".change").val() == "Публичный. Изменить на приватный" ? $(".change").val("Приватный. Изменить на публичный") : $(".change").val("Публичный. Изменить на приватный");
                }'
                    ), array(
                'class' => 'btn change ' . $class,
                'name' => 'save',
                    )
            );

            echo CHtml::endForm();
            ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php
    foreach ($model->accesses as $item) {
        if ($item->role == 1)
            continue;
        ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?= $item->user->username; ?>:</label>
            <div class="col-lg-9">
                <?php
                echo CHtml::form('', 'post', array('class' => 'translate'));

                if ($item->role == 5) {
                    $label = 'Доступ запрещен. Разрешить';
                    $newLabel = 'Доступ разрешен. Запретить';
                    $class = 'btn-danger';
                } else {
                    $label = 'Доступ разрешен. Запретить';
                    $newLabel = 'Доступ запрещен. Разрешить';
                    $class = 'btn-success';
                }

                echo CHtml::ajaxButton($label, '/access/changeAccess', array(
                    'type' => 'POST',
                    'data' => 'user_id=' . $item->user->id . '&docs_id=' . $model->id,
                    'success' => 'js:function(data){
                    $(".user_' . $item->user->id . '").toggleClass("btn-danger").toggleClass("btn-success");
                    $(".user_' . $item->user->id . '").val() == "Доступ запрещен. Разрешить" ? $(".user_' . $item->user->id . '").val("Доступ разрешен. Запретить") : $(".user_' . $item->user->id . '").val("Доступ запрещен. Разрешить");
                }'
                        ), array(
                    'class' => 'btn user_' . $item->user->id . ' ' . $class,
                    'name' => 'save_' . $item->user->id,
                        )
                );

                echo CHtml::endForm();
                ?>
            </div>
        </div>

        <?php
    }
    ?>

</div>
<div class="col-lg-4">
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
