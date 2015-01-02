<?php
$this->breadcrumbs = array(
    'Профиль ' . $user->username,
);
?>

<div class="col-md-12">

    <div class="col-md-6">
        <h2>Данные профиля</h2>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-md-3 control-label">Ник</label>

                <div class="col-md-9">
                    <p class="form-control-static"><?= $user->username; ?></p>
                </div>
            </div>
            <?php if ($user->id == Yii::app()->user->id || Y::hasAccess('administrator')) : ?>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>

                    <div class="col-md-9">
                        <p class="form-control-static"><?= $user->email; ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-md-3 control-label">Дата регистрации</label>

                <div class="col-md-9">
                    <p class="form-control-static"><?= date('d.m.Y', $user->reg_date); ?></p>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <?php if ($user->id == Yii::app()->user->id || Y::hasAccess('administrator')) : ?>
            <h2>Коды приглашений</h2>
            <?php
            if (isset($user->invites)) :
                foreach ($user->invites as $key => $invite) :
                    ?>
                    <div class="form-group">
                        <?php if (time() > $invite->hold) : ?>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Код приглашения"
                                       value="<?= $invite->code; ?>"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="element_<?= $key; ?>"
                                            data-clipboard-text="<?= $invite->code; ?>" type="button">Скопировать!
                                    </button>
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Код приглашения"
                                       value="<?= $invite->code; ?>" readonly="readonly"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" type="button">Инвайт выдан!</button>
                                </span>
                            </div>
                        <?php endif; ?>
                        <script>
                            var client<?= $key; ?> = new ZeroClipboard(document.getElementById("element_<?= $key; ?>"));
                            client<?= $key; ?>.on("aftercopy", function (event) {
                                $("#element_<?= $key; ?>").html("Скопировано!");
                                $("#element_<?= $key; ?>").addClass("btn-success");

                                $.ajax({
                                    url: '/editInvite',
                                    data: 'code=<?= $invite->code; ?>',
                                    type: 'post',
                                    async: false,
                                    success: function (data) {
                                    }
                                });
                            });
                        </script>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        <?php endif; ?>
    </div>
</div>

